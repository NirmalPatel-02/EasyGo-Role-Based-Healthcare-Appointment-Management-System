<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Bank;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in doctor
    
        // Initialize the query builder for wallets
        $walletQuery = DB::table('wallets')
            ->where('doctor_id', $user->id)
            ->join('users', 'wallets.client_id', '=', 'users.id')
            ->select(
                'wallets.*',
                'users.first_name as first_name',
                'users.last_name as last_name',
                'users.dob as dob',
                'users.phone as phone'
            );
    
        // Apply filtering based on 'created_at' if it's not null or blank
        $createdAt = $request->input('created_at');
        if (!is_null($createdAt) && trim($createdAt) !== '') {
            $walletQuery->whereDate('wallets.created_at', $createdAt);
        }
    
        // Apply filtering based on 'payment_id' if it's not null or blank
        $paymentId = $request->input('payment_id');
        if (!is_null($paymentId) && trim($paymentId) !== '') {
            $walletQuery->where('wallets.payment_id', $paymentId);
        }
    
        // Apply dynamic ordering
        $orderBy = strtolower($request->get('order_by', 'wallets.created_at')); // Default to `created_at`
        $orderDirection = strtolower($request->get('order_by_direction', 'desc')); // Default to `desc`
    
        // Validate order direction (only allow `asc` or `desc`)
        $orderDirection = in_array($orderDirection, ['asc', 'desc']) ? $orderDirection : 'desc';
    
        $walletQuery->orderBy($orderBy, $orderDirection);
    
        // Paginate the results with a dynamic `per_page` value, defaulting to 10
        $perPage = $request->input('per_page', 10);
        $walletsWithClients = $walletQuery->paginate($perPage);
    
        // Calculate today's earnings (credit), withdrawn amount (debit), and remaining balance
        $todayDate = now()->format('Y-m-d'); // Get today's date in Y-m-d format
    
        $todaysEarnings = DB::table('wallets')
            ->where('doctor_id', $user->id)
            ->whereDate('created_at', $todayDate)
            ->sum('credit'); // Sum of credits for today
    
        $withdrawnAmount = DB::table('wallets')
            ->where('doctor_id', $user->id)
            ->sum('debit'); // Sum of debits (withdrawn amounts)
    
        $totalCredits = DB::table('wallets')
            ->where('doctor_id', $user->id)
            ->sum('credit'); // Sum of credits
    
        $remainingBalance = $totalCredits - $withdrawnAmount; // Remaining balance after withdrawals
    
        // Fetch bank details
        $banks = DB::table('banks')
            ->where('doctor_id', $user->id)
            ->get();
    
        // Return a JSON response for API requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'wallets' => $walletsWithClients, // Include wallet entries with client data
                'withdrawnAmount' => $withdrawnAmount,
                'remainingBalance' => $remainingBalance,
                'todaysEarnings' => $todaysEarnings // Include today's earnings in the response
            ]);
        }
    
        // Pass data to the view
        return view('doctor-dashboard.transactions', compact(
            'walletsWithClients',
            'withdrawnAmount',
            'remainingBalance',
            'todaysEarnings',
            'banks'
        ));
    }
    
    
    
    // Get a single wallet entry by ID
    public function show(Request $request, $id)
    {
        $entry = Wallet::findOrFail($id);

        if ($request->expectsJson()) {
            return response()->json($entry,200); // API Response
        }

        return view('wallet.show', compact('entry')); // Web View
    }

    // Insert a new wallet entry
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'charges'   => 'required|numeric',
            'debit'     => 'required|numeric',
            'credit'    => 'required|numeric',
            'details'   => 'nullable|string',
        ]);

        $entry = Wallet::create($validatedData);

        if ($request->expectsJson()) {
            return response()->json($entry, 200); // API Response
        }

        return redirect()->route('wallet.index')->with('success', 'Wallet entry created successfully!'); // Web Redirect
    }

    // Update an existing wallet entry
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'client_id' => 'sometimes|exists:users,id',
            'doctor_id' => 'sometimes|exists:users,id',
            'charges'   => 'sometimes|numeric',
            'debit'     => 'sometimes|numeric',
            'credit'    => 'sometimes|numeric',
            'details'   => 'nullable|string',
        ]);

        $entry = Wallet::findOrFail($id);
        $entry->update($validatedData);

        if ($request->expectsJson()) {
            return response()->json($entry,200); // API Response
        }

        return redirect()->route('wallet.index')->with('success', 'Wallet entry updated successfully!'); // Web Redirect
    }

    // Delete a wallet entry
    public function destroy(Request $request, $id)
    {
        $entry = Wallet::findOrFail($id);
        $entry->delete();

        if ($request->expectsJson()) {
            return response()->json(["success"=>true,'message' => 'Entry deleted successfully']); // API Response
        }

        return redirect()->route('wallet.index')->with('success', 'Wallet entry deleted successfully!'); // Web Redirect
    }
}
