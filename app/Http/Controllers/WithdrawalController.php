<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\Bank;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Exception;

class WithdrawalController extends Controller
{
    // Display all withdrawals for the logged-in doctor
    public function index(Request $request)
    {
        $user = Auth::user(); // Get the currently logged-in doctor
    
        // Define base query for withdrawals
        $query = Withdrawal::where('doctor_id', $user->id);
    
        // Apply filters if present
        if ($request->has('bank_name') && $request->bank_name != '') {
            $query->where('bank_name', 'like', '%' . $request->bank_name . '%');
        }
    
        if ($request->has('created_at') && $request->created_at != '') {
            // Format the date to match your database format if necessary
            $query->whereDate('created_at', $request->created_at);
        }
    
        // Handle ordering
        $orderBy = strtolower($request->get('order_by', 'created_at')); // Default to `created_at`
        $orderDirection = strtolower($request->get('order_by', 'desc')); // Default to `desc`
    
        // Validate order direction (only allow `asc` or `desc`)
        $orderDirection = in_array($orderDirection, ['asc', 'desc']) ? $orderDirection : 'desc';
    
        $query->orderBy($orderBy, $orderDirection);
    
        // Paginate the results
        $perPage = $request->get('per_page', 10); // Default to 10 per page
        $withdrawals = $query->paginate($perPage);
    
        // Calculate total withdrawn amount
        $totalWithdrawn = $query->sum('amount');
    
        // Return a JSON response for API requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $withdrawals,
                'total_withdrawn' => $totalWithdrawn,
            ]);
        }
    
        // Return a view for web requests
        return view('doctor-dashboard.withdrawals', compact('withdrawals', 'totalWithdrawn'));
    }
    
    // Get a single withdrawal entry by ID
    public function show(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($request->expectsJson()) {
            return response()->json($withdrawal); // API Response
        }

        return view('withdrawals', compact('withdrawal')); // Web View
    }

    public function store(Request $request)
    {
        $user = Auth::user();
    
        // Calculate available balance
        $wallet = $user->doctorWallets();
        $availableBalance = $wallet->sum('credit') - $wallet->sum('debit');
    
        if ($availableBalance < 100 ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Low available balance. Minimum required balance is 100.',
                ], 200);
            }
    
            return redirect()->route('withdrawals')->with('errors', 'Low available balance. Minimum required balance is 100.');
        }
    
       
    
        // Validate the incoming data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'bank_id' => 'required|exists:banks,id',
        ]);
        if ($availableBalance < $validatedData["amount"] ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter withdrawal amount less or equal to wallet balance',
                ], 200);
            }
    
            return redirect()->route('withdrawals')->with('errors', 'Please enter withdrawal amount less or equal to wallet balance');
        }
        // Fetch the associated bank
        $bank = Bank::find($validatedData['bank_id']);
    
        if (!$bank || $bank->doctor_id != $user->id) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid bank or this bank is not associated with your account.',
                ], 200);
            }
    
            return redirect()->route('withdrawals')->with('error', 'Invalid bank or this bank is not associated with your account.');
        }
    
        // Assign additional data for withdrawal
        $validatedData['doctor_id'] = $user->id;
        $validatedData['bank_name'] = $bank->bank_name;
        $validatedData['account_no'] = $bank->account_no;
        $validatedData['ifsc'] = $bank->ifsc;
        $validatedData['branch_name'] = $bank->branch_name;
        $validatedData['holder_name'] = $bank->holder_name;
        $validatedData['status'] = "Pending";
        $validatedData['file'] = "";
    
        try {
            // Attempt to create the withdrawal
            $withdrawal = Withdrawal::create($validatedData);
    
            // Create a wallet entry to debit the amount from the available balance
            Wallet::create([
                'doctor_id' => $user->id,  // Use the doctor's ID
                'client_id' => $user->id,  // Assuming the client ID is the same as doctor ID
                'charges' =>0,  // Assuming the client ID is the same as doctor ID
                'debit' => $validatedData['amount'], // The amount being debited
                'credit' => 0,  // No credit for withdrawal, just debit
                'details' => 'Withdrawal debited: ' . $validatedData['amount'],
                'transaction_id' => "",  // No credit for withdrawal, just debit
            ]);
    
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Withdrawal Successful',
                ], 200);
            }
    
            return redirect()->route('withdrawals')->with('success', 'Withdrawal entry created successfully!');
        } catch (QueryException $e) {
            // Handle database-related errors
            $errorMessage = $e->getMessage();
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Database error occurred while processing your request.'.$errorMessage,
                    'error' => $errorMessage, // You might omit this in production for security reasons
                ], 200); // Internal Server Error
            }
    
            return redirect()->route('withdrawals')->with('error', 'Database error occurred while processing your request.');
        } catch (Exception $e) {
            // Handle other general exceptions
            $errorMessage = $e->getMessage();
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An unexpected error occurred.',
                    'error' => $errorMessage, // You might omit this in production
                ], 200); // Internal Server Error
            }
    
            return redirect()->route('withdrawals')->with('error', 'An unexpected error occurred.');
        }
    }
    
    

    

    // Update an existing withdrawal entry
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'doctor_id'   => 'sometimes|exists:users,id',
            'amount'      => 'sometimes|numeric',
            'status'      => 'sometimes|string|max:50',
            'remarks'     => 'nullable|string',
            'bank_name'   => 'sometimes|string|max:100',
            'account_no'  => 'sometimes|string|max:50',
            'ifsc'        => 'sometimes|string|max:50',
            'branch_name' => 'sometimes|string|max:150',
            'holder_name' => 'sometimes|string|max:50',
        ]);

        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->update($validatedData);

        if ($request->expectsJson()) {
            return response()->json($withdrawal); // API Response
        }

        return redirect()->route('withdrawals')->with('success', 'Withdrawal entry updated successfully!'); // Web Redirect
    }

    // Delete a withdrawal entry
    public function destroy(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Entry deleted successfully']); // API Response
        }

        return redirect()->route('withdrawals')->with('success', 'Withdrawal entry deleted successfully!'); // Web Redirect
    }
}
