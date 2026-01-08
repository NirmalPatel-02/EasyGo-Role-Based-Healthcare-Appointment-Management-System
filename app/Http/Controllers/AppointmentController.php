<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Language;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Slot;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Razorpay\Api\Api;
class AppointmentController extends Controller
{
    public function show(Request $request)
    {
        // Check if 'hashid' is in the request for doctor lookup
        if ($request->has('hashid')) {
            $hashid = $request->hashid;
            $doctor = User::whereRaw('SHA1(id) = ?', [$hashid])->firstOrFail();
            
            // Manually load reviews
            $doctor->reviews = Review::where('doctor_id', $doctor->id)->get();
        
            // Instantiate DoctorController and call the findSimilarDoctors method
            $similarDoctors = $this->findSimilarDoctors([
                'speciality' => $doctor->speciality,
                'city' => $doctor->city,
                'radius' => 50, // Example radius
                'exclude_id' => $doctor->id, // Exclude the current doctor
            ]);
           
            return view('book_appointment', compact('doctor', 'similarDoctors'));
        }
    
        // Handle request parameters for GET request
        $doctor_id = $request->input('doctor_id');
        $dated = $request->input('dated');
        $slot = $request->input('slot');
        
        // Find the doctor by ID and manually load reviews
        $doctor = User::findOrFail($doctor_id);
        $doctor->reviews = Review::where('doctor_id', $doctor->id)->where("status","Approved")->get();
        
        $sha1 = sha1($doctor->id);
        $settings = DB::table('settings')->first();
        
        // Instantiate DoctorController and call the findSimilarDoctors method
        $similarDoctors = $this->findSimilarDoctors([
            'speciality' => $doctor->speciality,
            'city' => $doctor->city,
            'radius' => 50, // Example radius
            'exclude_id' => $doctor->id, // Exclude the current doctor
        ]);
       
        return view('appointment_details', compact('doctor', 'dated', 'slot', 'sha1', 'settings', 'similarDoctors'));
    }
    
    public function findSimilarDoctors(array $criteria)
    {
        $query = User::where('role', 'doctor');
        
        // Apply filters based on criteria
        if (isset($criteria['speciality'])) {
            $query->where('speciality', 'like', '%' . $criteria['speciality'] . '%');
        }
        if (isset($criteria['city'])) {
            $query->where('city', 'like', '%' . $criteria['city'] . '%');
        }
        
        // Check if latitude and longitude are provided for proximity filtering
        if (isset($criteria['radius']) && isset($criteria['latitude']) && isset($criteria['longitude'])) {
            $query->nearby($criteria['latitude'], $criteria['longitude'], $criteria['radius']);
        }
    
        // Ensure the doctor's status is 'Approved'
        $query->where('status', 'Approved');
        
        // Exclude the current doctor by checking against the current doctor's ID
        if (isset($criteria['exclude_id'])) {
            $query->where('id', '!=', $criteria['exclude_id']);
        }
    
        // Fetch the doctors, limit to a max of 10 similar doctors
        $doctors = $query->limit(10)->get();
        
        // Enrich the doctor data with additional information
        $doctors->transform(function ($doctor) {
            // Add SHA1 hash of the doctor's ID
            $doctor->id_sha1 = sha1($doctor->id);
    
            // Fetch associated data like languages
            $doctor->languages = Language::where('doctor_id', $doctor->id)->get();
    
            return $doctor;
        });
    
        return $doctors; // Return the enriched collection of similar doctors
    }
    


public function view(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Determine the method to call based on the user's role
    if ($user->role == 'client') {
        // If the user is a client, use the clientAppointments relation
        $appointment = $user->clientAppointments()->where('id', $request->id)->first();
        $view = 'reschedule-appointment'; // View for clients
    } elseif ($user->role == 'doctor') {
        // If the user is a doctor, use the doctorAppointments relation
        $appointment = $user->doctorAppointments()->where('id', $request->id)->first();
        $view = 'doctor-dashboard.appointments'; // View for doctors
    } else {
        // If the user role is neither client nor doctor, handle the case accordingly
        return redirect()->back()->with('error', 'Invalid appointment');
    }

    // Check if the appointment exists
    if ($appointment) {
        // Retrieve the related doctor
        $doctor = $appointment->doctor;
        $dated = $appointment->dated;
        $slot = $appointment->time_slot;
        $reviews = Review::where('doctor_id', $doctor->id)->get();
        // Pass the appointment data to the respective view
        return view($view, compact('appointment', 'dated', 'slot', 'doctor'));
    } else {
        // If appointment not found, return an error
        return redirect()->back()->with('error', 'Appointment not found');
    }
}



   
public function getAvailableSlots(Request $request)
{
    // Ensure inputs are valid
    $date = trim($request->dated);
    $doctorId = intval($request->doctor_id);

    if (!$doctorId || !$date) {
        return response()->json(['error' => 'Invalid doctor ID or date.'], 400);
    }

    // Current time in the same format as slot_time (e.g., "11:00 AM")
    $currentTime = now()->format('h:i A');

    // Fetch all slots for the doctor
    $availableSlots = DB::table('slots')
        ->where('doctor_id', $doctorId)
        ->pluck('time_slot')
        ->toArray();

    // Filter slots to include only those after the current time
    if ($date === now()->format('Y-m-d')) { // Only filter for today's date
        $availableSlots = array_filter($availableSlots, function ($slot) use ($currentTime) {
            return strtotime($slot) > strtotime($currentTime);
        });
    }

    // Fetch booked appointments for the doctor on the given date
    $bookedAppointments = DB::table('appointments')
        ->where('doctor_id', $doctorId)
        ->where('dated', 'LIKE', '%' . $date . '%')
        ->whereIn('status', ['Pending', 'Confirmed'])
        ->pluck('time_slot')
        ->toArray();

    // Get slots that are not booked
    $notBookedSlots = array_diff($availableSlots, $bookedAppointments);

    // Separate available slots into morning and afternoon
    $morningAvailable = array_filter($notBookedSlots, function ($slot) {
        return str_contains($slot, 'AM');
    });
    $afternoonAvailable = array_filter($notBookedSlots, function ($slot) {
        return str_contains($slot, 'PM');
    });

    // Separate booked slots into morning and afternoon
    $morningBooked = array_filter($bookedAppointments, function ($slot) {
        return str_contains($slot, 'AM');
    });
    $afternoonBooked = array_filter($bookedAppointments, function ($slot) {
        return str_contains($slot, 'PM');
    });

    // Prepare the response
    return response()->json([
        'notBookedSlots' => array_values($notBookedSlots),
        'available_slots' => [
            'morning' => array_values($morningAvailable),
            'afternoon' => array_values($afternoonAvailable),
        ],
        'booked_slots' => [
            'morning' => array_values($morningBooked),
            'afternoon' => array_values($afternoonBooked),
        ],
        'all_slots' => array_values($availableSlots), // Optional, keeps all slots together if needed
    ]);
}



public function cancelAppointment($id)
{
    $appointment = Appointment::findOrFail($id);

    // Ensure status is Pending, Rejected, Confirmed, or Cancelled
    if (!in_array($appointment->status, ['Pending', 'Rejected', 'Confirmed'])) {
        return response()->json(['type'=>'error','title'=>'Not cancelled','message' => 'This appointment cannot be cancelled'], 200);
    }

    if (now()->diffInHours($appointment->created_at->setTimezone(config('app.timezone'))) > 24) {
        return response()->json([
            'type' => 'error',
            'title' => 'Not cancelled',
            'message' => 'Appointments can only be cancelled within 24 hours',
        ], 200);
    }
    
    // Update the status to Cancelled
    $appointment->status = 'Cancelled';
    $appointment->save();

    // Raise Razorpay refund request
    try {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $refund = $api->payment->fetch($appointment->payment_id)->refund([
            'amount' => $appointment->amount * 100, // Razorpay expects amount in the smallest currency unit
            'notes' => [
                'appointment_id' => $appointment->id,
                'reason' => 'Same-day cancellation',
            ]
        ]);

        // Store refund details in the database
        Refund::create([
            'appointment_id' => $appointment->id,
            'client_id' => $appointment->client_id,
            'doctor_id' => $appointment->doctor_id,
            'payment_id' => $appointment->payment_id,
            'amount' => $appointment->amount,
        ]);

        return response()->json(['type'=>'success','title'=>'Cancelled','message' => 'Appointment cancelled successfully and refund processed']);
    } catch (\Exception $e) {
        return response()->json(['type'=>'error','title'=>'Refund Failed','message' => 'Appointment cancelled but refund processing failed: ' . $e->getMessage()], 200);
    }
}


    public function updateAppointment(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'time_slot' => 'required',
            'dated' => 'required|date',
            'status' => 'required|in:Confirmed,Pending', // Ensure valid status
        ]);
    
        $timeSlot = $request->time_slot;
        $dated = $request->dated;
    
        $appointment = Appointment::findOrFail($id);
        $doctorId = $appointment->doctor_id;
    
        // Check if the time slot is already booked for the doctor
        $isSlotUsed = Appointment::where('doctor_id', $doctorId)
            ->where('time_slot', $timeSlot)
            ->where('dated', $dated)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->exists();
    
        if ($isSlotUsed) {
            $errorResponse = [
                'status' => 'error',
                'message' => 'This time slot is no longer available.',
            ];
    
            if ($request->expectsJson()) {
                return response()->json($errorResponse, 200);
            } else {
                return redirect()->route('client.appointments')->withErrors($errorResponse);
            }
        }
    
        if ($appointment->client_id != Auth::id() && $appointment->doctor_id != Auth::id()) {
            $errorResponse = ['message' => 'Unauthorized action'];
    
            if ($request->expectsJson()) {
                return response()->json($errorResponse, 200);
            } else {
                return redirect()->route('client.appointments')->withErrors($errorResponse);
            }
        }
    
        $appointment->time_slot = $timeSlot;
        $appointment->dated = $dated;
    
        if (Auth::user()->role === 'client') {
            $appointment->status = "Pending";
        } else {
            $appointment->status = "Confirmed";
        }
    
        $appointment->save();
     
        $successMessage = 'Appointment updated successfully';
    
        if (Auth::user()->role === 'doctor') {
            // Flash success message for doctor and redirect to getAppointments
            session()->flash('success', $successMessage);
            return $this->getAppointments($request);
        }
    
        if ($request->expectsJson()) {
            return response()->json(['message' => $successMessage], 200);
        } else {
            return redirect()->route('client.appointments')->with('success', $successMessage);
        }
    }
    
    
    
    

 // Method for doctor to accept, reject, or complete appointment
public function updateStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:Confirmed,Rejected,Completed',
    ]);

    $appointment = Appointment::findOrFail($id);
    $doctor = Auth::user();

    if ($appointment->doctor_id != $doctor->id) {
        return response()->json(['message' => 'Unauthorized action'], 200);
    }

    // Update the status of the appointment
    $appointment->status = $validated['status'];
    $appointment->save();
    // dd($validated['status']);
    // Create wallet entry only if the status is Confirmed and payment_id doesn't already exist in the wallet
    if ($validated['status'] === 'Completed') {
        $existingWalletEntry = Wallet::where('payment_id', $appointment->payment_id)->exists();

        if (!$existingWalletEntry) {
            $settings = DB::table('settings')->get();
            $amount=$appointment->doctor_price-$appointment->commission_amount;
         
            Wallet::create([
                'client_id' => $appointment->client_id,
                'doctor_id' => $doctor->id,
                'charges' => $doctor->price,
                'debit' =>0,
                'credit' =>  $amount,
                'details' => 'Payment for appointment booking',
                'payment_id' => $appointment->payment_id, // Assuming Wallet has a payment_id column
            ]);
        }
    }

    return response()->json(['message' => 'Appointment status updated successfully'],200);
}
public function getAppointments(Request $request)
{
    $user = Auth::user();
    $url = 'doctor-dashboard.appointments';

    // Determine the appointments query based on the user role
    if ($user->role == 'client') {
        $appointments = $user->clientAppointments()->with('doctor');
        $url = 'appointments';
    } elseif ($user->role == 'doctor') {
        $appointments = $user->doctorAppointments()->with('client');
    } else {
        return redirect()->route('home')->with('error', 'Unauthorized access');
    }

    // Filter by status if provided
    $appointments->when($request->has('status'), function ($query) use ($request) {
        $query->where('status', $request->status);
    });

    // Filter by date if provided
    $appointments->when($request->has('dated'), function ($query) use ($request) {
        if (!is_null($request->dated) && trim($request->dated) !== '') {
        $query->whereDate('dated', $request->dated);
        }
    });

    // Filter by first name or last name if provided
   // Filter by first name or last name if provided
$appointments->when($request->has('query'), function ($query) use ($request) {
    $queryString = $request->input('query'); // Get the specific query parameter

    if (!is_null($queryString) && trim($queryString) !== '') {
        $query->whereRaw('LOWER(appointments.first_name) LIKE ?', ['%' . strtolower($queryString) . '%'])
              ->orWhereRaw('LOWER(appointments.last_name) LIKE ?', ['%' . strtolower($queryString) . '%']);
    }
});


    // Handle ordering
    $orderBy = strtolower($request->get('order_by', 'created_at')); // Default to `created_at`
    $orderDirection = strtolower($request->get('order_by', 'desc')); // Default to `desc`

    // Validate order direction (only allow `asc` or `desc`)
    $orderDirection = in_array($orderDirection, ['asc', 'desc']) ? $orderDirection : 'desc';

    $appointments->orderBy($orderBy, $orderDirection);

    // Get the per page value from the request, default to 10 if not provided
    $perPage = $request->input('per_page', 10);

    // Paginate the appointments with the dynamic per page value
    $appointments = $appointments->paginate($perPage);

    $appointments->getCollection()->transform(function ($appointment) {
        $appointment->review = Review::where('appointment_id', $appointment->id)->where('status','Approved')->first() ?? null;
        return $appointment;
    });
    

    if ($request->wantsJson()) {
        return response()->json(['appointments' => $appointments], 200);
    }

    // Pass flash messages and pagination data to the view
    $successMessage = session('success');
    return view($url, compact('appointments', 'successMessage'));
}



public function doctorDashboard(Request $request)
{
    $doctor = Auth::user(); // Get authenticated user (current doctor)
    $slots = $doctor->slots(); // Get doctor's slots
    if($doctor->status==="Deleted")
    {
    Auth::logout();
    }   
    // Fetch the doctor's appointments with client information
    $appointments = $doctor->doctorAppointments()
        ->with('client') // Include client info
        ->get();

    // Get today's date
    $today = now()->toDateString();
    $totalAppointments = $appointments->count();
    // Calculate counts
    $todaysAppointments = $appointments->where('dated', $today)->count(); // Today's appointments
    // Total appointments

    // Count remaining appointments with status 'Pending' or 'Confirmed'
    $remainingAppointments = $doctor->doctorAppointments()
        ->where(function ($query) {
            $query->where('status', 'like', 'Pending')
                  ->orWhere('status', 'like', 'Confirmed');
        })
        ->count(); // Remaining appointments (Pending or Confirmed)

    $pendingRequests = $appointments->where('status', 'Pending')->count(); // Pending appointments

    // Data to return
    $data = [
        'doctor' => $doctor,
        'appointments' => $appointments,
        'todaysAppointments' => $todaysAppointments,
        'totalAppointments' => $totalAppointments,
        'remainingAppointments' => $remainingAppointments,
        'pendingRequests' => $pendingRequests,
        'slots' => $slots,
    ];

    // Check if the request expects a JSON response
    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    // For web requests, return the view
    return view("doctor-dashboard.index", compact('doctor', 'appointments', 'todaysAppointments', 'totalAppointments', 'remainingAppointments', 'slots'));
}


    
    public function storeReview(Request $request)
{
    $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
        'star' => 'required|integer|min:1|max:5',
        'remarks' => 'nullable|string|max:255',
    ]);

    $appointment = Appointment::findOrFail($request->appointment_id);

    // Check if appointment status is 'Completed'
    if ($appointment->status != 'Completed') {
        return response()->json(['message' => 'Only completed appointments can be reviewed.'], 400);
    }

    // Check if review already exists
    if ($appointment->review) {
        return response()->json(['message' => 'A review already exists for this appointment.'], 400);
    }

    // Store the review
    $review = new Review();
    $review->doctor_id = $appointment->doctor_id;
    $review->client_id = $appointment->client_id;
    $review->appointment_id = $appointment->id;
    $review->star = $request->star;
    $review->remarks = $request->remarks;
    $review->save();

    return response()->json(['message' => 'Review submitted successfully.'], 200);
}


    }
