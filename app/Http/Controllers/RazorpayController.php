<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Razorpay\Api\Api;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RazorpayController extends Controller
{
    // Display payment form
    public function showForm()
    {
        return view('razorpay.payment');
    }

    public function createOrder(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'time_slot' => 'required|string',
            'dated' => 'required|date',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
            'dob' => 'required|date',
            'gender' => 'required|string|in:Male,Female,Other',
        ]);
    
        // Check slot availability
        if ($this->isSlotUnavailable($validated['doctor_id'], $validated['time_slot'], $validated['dated'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'This time slot is no longer available.',
            ], 200);
        }
    
        // Calculate amount details
        $doctor = User::find($validated['doctor_id']);
        $settings = DB::table('settings')->first();
        $gst = ($doctor->price * $settings->gst) / 100;
        $platformFee = $settings->platform_fee;
        $totalAmount = $doctor->price + $gst + $platformFee;
    
        if (abs($totalAmount - $validated['amount']) > 0.01) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid amount.',
            ], 200);
        }
    
        try {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt' => Auth::id() . '-' . uniqid(),
                'amount' => $validated['amount'] * 100, // Amount in paise
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);
    
            // Save order details
            DB::table('orders')->insert([
                'order_id' => $razorpayOrder->id,
                'client_id' => Auth::id(),
                'doctor_id' => $validated['doctor_id'],
                'time_slot' => $validated['time_slot'],
                'dated' => $validated['dated'],
                'status' => 'Pending',
                'doctor_price' => $doctor->price,
                'commission_rate' => $doctor->commission_rate,
                'gst_percent' => $settings->gst,
                'gst_amount' => $gst,
                'platform_fee' => $platformFee,
                'total_amount' => $totalAmount,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'dob' => $validated['dob'],
                'gender' => $validated['gender'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder->id,
                'amount' => $razorpayOrder->amount,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating Razorpay order: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error processing your request.',
            ], 200);
        }
    }
    

    public function verifyPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => 'required|string',
            'order_id' => 'required|string|exists:orders,order_id',
            'doctor_id' => 'required|exists:users,id',
        ]);
    
        try {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $payment = $api->payment->fetch($validated['payment_id']);
    
            if ($payment->status !== 'captured') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Payment verification failed.',
                ], 401);
            }
    
            // Fetch order details
            $order = DB::table('orders')->where('order_id', $validated['order_id'])->first();
    
            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found.',
                ], 401);
            }
     // Check slot availability
     if ($this->isSlotUnavailable($order->doctor_id, $order->time_slot,$order->dated)) {
        return response()->json([
            'status' => 'error',
            'message' => 'This time slot is no longer available.',
        ], 401);
    }
    $settings = DB::table('settings')->first();
            // Update order and create appointment
            $rate=$order->commission_rate!=$settings->commission_rate?$order->commission_rate:$settings->commission_rate;
            $commission=$order->doctor_price*$rate/100;
            // dd($commission);
            DB::transaction(function () use ($validated, $order, $payment,$commission) {
                DB::table('orders')->where('order_id', $validated['order_id'])->update([
                    'status' => 'Completed',
                    'payment_id' => $validated['payment_id'],
                    'updated_at' => now(),
                ]);
               
                Appointment::create([
                    'client_id' => $order->client_id,
                    'doctor_id' => $order->doctor_id,
                    'time_slot' => $order->time_slot,
                    'dated' => $order->dated,
                    'status' => 'Pending',
                    'order_id' => $order->order_id,
                    'payment_id' => $validated['payment_id'],
                    'doctor_price' => $order->doctor_price,
                    'commission_rate' => $order->commission_rate,
                    'commission_amount' =>$commission,
                    'gst_percent' => $order->gst_percent,
                    'gst_amount' => $order->gst_amount,
                    'platform_fee' => $order->platform_fee,
                    'total_amount' => $order->total_amount,
                    'first_name' => $order->first_name,
                    'last_name' => $order->last_name,
                    'phone' => $order->phone,
                    'dob' => $order->dob,
                    'gender' => $order->gender,
                ]);
            });
    
            return response()->json([
                'status' => 'success',
                'message' => 'Your appointment has been booked successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error verifying payment: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Payment verification failed.'. $e->getMessage(),
            ], 401);
        }
    }
    

    // Private helper methods
    private function isSlotUnavailable($doctorId, $timeSlot, $dated)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('time_slot', $timeSlot)
            ->where('dated', $dated)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->exists();
    }

    private function validateAmount($doctorId, $inputAmount)
    {
        $doctor = User::find($doctorId);
        if (!$doctor) return false;

        $settings = DB::table('settings')->first();
        $gst = ($doctor->price * $settings->gst) / 100;
        $platformFee = $settings->platform_fee;

        $expectedAmount = $doctor->price + $gst + $platformFee;

        return abs($expectedAmount - $inputAmount) < 0.01;
    }
}
