<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Review;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\Withdrawal;

use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    protected $exportController;

    public function __construct(ExportController $exportController)
    {
        $this->exportController = $exportController;
    }


    public function dashboard()
    {
        // Get the data from the database
        $totalcommission = Appointment::where('status', 'completed')->sum('commission_amount'); // Total earnings from completed appointments
        $totalplatform = Appointment::where('status', 'completed')->sum('platform_fee'); // Total earnings from completed appointments
        $totalgst = Appointment::where('status', 'completed')->sum('gst_amount'); // Total earnings from completed appointments
        $totalearnings = Appointment::where('status', 'completed')->sum('total_amount'); // Total earnings from completed appointments
        $totalBookings = Appointment::count();  // Total number of bookings
        $totalCustomers = User::where('role', 'client')->count();  // Count of customers
        $totalDoctors = User::where('role', 'doctor')->count();  // Count of doctors
        $todayEarnings = Appointment::where('status', 'completed')
            ->whereDate('updated_at', today())
            ->sum('total_amount'); // Today's earnings from completed appointments
        $todayBookings = Appointment::whereDate('created_at', today())->count(); // Bookings created today
        $pendingBookings = Appointment::where('status', 'pending')->count(); // Pending bookings count
    
        // Pass the data to the view
        return view('admin.index', compact(
            'totalearnings',
            'totalcommission', 
            'totalplatform', 
            'totalgst', 
            
            'totalBookings',
            'totalCustomers',
            'totalDoctors',
            'todayEarnings',
            'todayBookings',
            'pendingBookings'
        ));
    }
    

public function settings()
{
    $settings = DB::table('settings')->first();
    // Pass the data to the view
    return view('admin.settings', compact('settings'));
}
public function updateSettings(Request $request)
{
    $request->validate([
        'gst' => 'required|numeric|min:0|max:100',
        'commission_rate' => 'required|numeric|min:0|max:100',
        'platform_fee' => 'required|numeric|min:0',
    ]);

    // Update the settings
    DB::table('settings')->update([
        'gst' => $request->gst,
        'commission_rate' => $request->commission_rate,
        'platform_fee' => $request->platform_fee,
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Settings updated successfully!');
}
public function reviews(Request $request)
{
    $query = Review::query()->orderBy("id","desc");;

    // Filter by Doctor ID
    if ($request->filled('doctor_id')) {
        $query->where('doctor_id', $request->doctor_id);
    }

    // Filter by Client ID
    if ($request->filled('client_id')) {
        $query->where('client_id', $request->client_id);
    }

    // Filter by Appointment ID
    if ($request->filled('appointment_id')) {
        $query->where('appointment_id', $request->appointment_id);
    }

    // Filter by Date Range
    if ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    $reviews = $query->paginate(10);
    if ($request->has('export')) {
        if ($request->input('export') === 'excel') {
            return $this->exportController->exportReviewsExcel($reviews);
         }
    }
    return view('admin.reviews', compact('reviews'));
}
public function listNotifications(Request $request)
{
    $query = Notification::query()->orderBy("id","desc");;

    // Filter by Client ID
    if ($request->filled('client_id')) {
        $query->where('client_id', $request->client_id);
    }

    // Filter by Doctor ID
    if ($request->filled('doctor_id')) {
        $query->where('doctor_id', $request->doctor_id);
    }

    // Filter by Status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Pagination
    $notifications = $query->paginate(10);

    return view('admin.notifications', compact('notifications'));
}
public function storeNotification(Request $request)
{
    // Validate Input
    $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string',
       'status' => 'nullable|string|in:Pending,Completed',
    ]);

    // Create Notification
    Notification::create([
        'title' => $request->input('title'),
        'message' => $request->input('message'),
        'client_id' => $request->input('client_id',0),
        'doctor_id' => $request->input('doctor_id',0),
        'appointment_id' => $request->input('appointment_id',0),
        'status' => $request->input('status', 'Pending'),
    ]);

    return redirect()->back()->with('success', 'Notification added successfully.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Approved,Rejected,Blocked,Pending',
    ]);

    $review = Review::findOrFail($id);
    $review->status = $request->status;
    $review->save();

    return redirect()->back()->with('success', 'Review status updated successfully.');
}

    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.login'); // Create a Blade view for this
    }
    public function adminLogout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
    // Handle admin login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check if the logged-in user is an admin
            $user = Auth::user();
            if ($user->role !== 'admin') {
                Auth::logout();
                return redirect()->back()->withErrors(['error' => 'Unauthorized Access!']);
            }

            return redirect()->route('adminDashboard');
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials!']);
    }
    public function findUser($id)
{
    // Fetch user by ID along with related data like slots, conditions, experiences, languages, galleries, and certificates
    $user = User::with([
        'slots',
        'conditions',    // Add conditions relationship
        'experiences',   // Add experiences relationship
        'languages',     // Add languages relationship
        'galleries',     // Add galleries relationship
        'certificates'   // Add certificates relationship
    ])->find($id);

    // Check if user exists
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $alllanguages= DB::table('alllanguages')->pluck('name');
    $states = DB::table('states')->where('country_id', 101)->get();
    

    // Get pagination parameters from the request, or set default values
    $perPage = request()->get('per_page', 10); // Default to 10 if not provided
    $paymentId = request()->get('payment_id', null); // Payment ID search parameter
    // Fetch cities from these states
    $cities = DB::table('cities')->whereIn('state_id', $states->pluck('id'))->get();
    // Check the user's role and return the corresponding view
     // Build the appointment query based on user role
     $appointmentsQuery = Appointment::query();

     if ($paymentId) {
         $appointmentsQuery->where('payment_id', $paymentId); // Filter by payment_id if provided
     }
 
     if ($user->role === 'doctor') {
         $appointments = $appointmentsQuery->where('doctor_id', $user->id)->paginate($perPage);
     } else {
         $appointments = $appointmentsQuery->where('client_id', $user->id)->paginate($perPage);
     }
 
    if ($user->role === 'doctor') {
        // Calculate total earnings (sum of all credits in the wallets table)
        $totalEarning = DB::table('wallets')
        ->where('doctor_id', $user->id)
        ->sum('credit');

        // Calculate total withdrawals (sum of all amounts in the withdrawals table)
        $totalWithdrawal = DB::table('withdrawals')
        ->where('doctor_id', $user->id)
        ->sum('amount');

        // Calculate balance (sum of credits minus sum of debits)
        $balance = DB::table('wallets')
        ->where('doctor_id', $user->id)
        ->selectRaw('SUM(credit) - SUM(debit) as balance')
        ->value('balance');

        // Prepare the wallet data
        $wallet = [
        'totalEarning' => $totalEarning+0,
        'totalwithdrawal' => $totalWithdrawal+0,
        'balance' => $balance+0,
        ];
        return view('admin.doctor_view', compact('user','cities','states','appointments','wallet'));
    } else {
        
        return view('admin.client_view', compact('user','cities','states','appointments'));
    }
}

public function updateUser(Request $request)
{
    // Fetch the user by ID
    
    $user = User::findOrFail($request->id);
    $allowedFields = [
        
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255' ,
        'phone' => 'nullable|string|max:20' ,
        'password' => 'nullable|string|min:6',
        'role' => 'nullable|string|in:client,doctor,admin',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'city' => 'nullable|string|max:255',
        'locality' => 'nullable|string|max:255',
        'dob' => 'nullable|date',
        'gender' => 'nullable|string|in:male,female,other',
        'speciality' => 'nullable|string|max:255',
        'experience' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:20',
        'language' => 'nullable|string|max:255',
        'education' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:500',
        'certification_name' => 'nullable|string|max:255',
        'certified_by' => 'nullable|string|max:255',
        'completion_date' => 'nullable|date',
        'price' => 'nullable|numeric|min:0',
        'longitude' => 'nullable|numeric',
        'latitude' => 'nullable|numeric',
        'commission_rate' => 'nullable|numeric',
        'status' => 'nullable|string|in:Approved,Pending,Rejected,Blocked',
    ];
    if ($request->email && $request->email !== $user->email) {
        $allowedFields['email'] = 'nullable|email|max:255';
    }
    
    if ($request->phone && $request->phone !== $user->phone) {
        $allowedFields['phone'] = 'nullable|string|max:20';
    }
    $validatedData = $request->validate($allowedFields);
   
    if ($request->has('password') && $request->password) {
        $validatedData['password'] = Hash::make($request->password);
    }

    if ($request->hasFile('avatar')) {
        $avatarFile = $request->file('avatar');
        $avatarFilename = Str::uuid() . '.' . $avatarFile->getClientOriginalExtension();
        $avatarFile->move(public_path('avatars'), $avatarFilename);
        $validatedData['avatar'] = $avatarFilename;
    }
    $settings = DB::table('settings')->first();
    
    $user->update($validatedData);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'user' => $user,
        ], 200);
    }

    // Determine redirect route based on user role
    $redirectRoute = $user->role === 'doctor' ? 'doctorEdit' : 'clientEdit';

    return redirect()->route($redirectRoute, ['id' => $user->id])
                     ->with('success', 'User profile has been updated successfully!');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'phone' => 'required|string|max:20|unique:users',
        'speciality' => 'required|string|max:255',
        'bio' => 'required|string|max:1000',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|string|in:Approved,Pending,Rejected',
        'role' => 'required|string|in:doctor,client,admin',
        'city' => 'required|string',
        'state' => 'required|string',
    ]);

    // Handle avatar upload
    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('avatars'), $avatarName);
        $validatedData['avatar'] = $avatarName;
    }

    // Create a new doctor profile
    $doctor = User::create($validatedData);

    return redirect()->route('admin.doctorList')->with('success', 'Doctor profile created successfully!');
}

    public function listUsers(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'search_date' => 'nullable|date', // Validate search_date
            'search_name' => 'nullable|string|max:255', // Validate search_name
            'phone' => 'nullable|string|max:255', // Validate search_name
        ]);
    
        // Get parameters
        $role = $request->input('role');
        $status = $request->input('status');
        $perPage = $request->input('per_page', 10);
        $searchDate = $request->input('search_date');
        $searchName = $request->input('search_name');
        $phone = $request->input('phone');
    
        // Build the query
        $query = User::where('role', '!=', 'admin')->orderBy("id","desc");;
    
        // Filter by role
        if ($role) {
            $query->where('role', $role);
        } else {
            $query->whereIn('role', ['doctor', 'client']);
        }
    
        // Filter by status
        if ($status) {
            $query->where('status', $status);
        }
    
        // Filter by search_name on first_name or last_name
        if ($searchName) {
            $query->where(function ($q) use ($searchName) {
                $q->where('first_name', 'like', "%{$searchName}%")
                  ->orWhere('last_name', 'like', "%{$searchName}%");
            });
        }
      // Filter by search_name on first_name or last_name
      
      if ($phone) {
        $query->where(function ($q) use ($phone) {
            $q->where('phone',  $phone);
              
        });
    }

        // Filter by search_date on created_at
        if ($searchDate) {
            $query->whereDate('created_at', $searchDate);
        }
    
        // Fetch paginated users
        $users = $query->paginate($perPage);
    
        // Check for export action
        if ($request->has('export')) {
            if ($request->input('export') === 'excel') {
                return $this->exportController->exportUsersExcel($users);
             }
        }
        $alllanguages= DB::table('alllanguages')->pluck('name');
        $states = DB::table('states')->where('country_id', 101)->get();
    
        // Fetch cities from these states
        $cities = DB::table('cities')->whereIn('state_id', $states->pluck('id'))->get();
        // Render the view
        $viewName = $role === 'doctor' ? 'admin.doctors' : 'admin.clients';
        return view($viewName, compact('users', 'role', 'perPage', 'searchName', 'searchDate','cities','states'));
    }
    public function listAppointments(Request $request)
    {
        // Validate the request parameters
        $request->validate([
            'per_page' => 'nullable|integer|min:1|max:100',
            'created_at_from' => 'nullable|date',
            'created_at_to' => 'nullable|date',
            'dated_from' => 'nullable|date',
            'dated_to' => 'nullable|date',
            'doctor_id' => 'nullable|integer|exists:users,id',
            'client_id' => 'nullable|integer|exists:users,id',
            'status' => 'nullable|string|max:50',
            'payment_id' => 'nullable|string|max:255',
            'doctor_name' => 'nullable|string|max:255',
            'doctor_phone' => 'nullable|string|max:20',
            'client_name' => 'nullable|string|max:255',
            'client_phone' => 'nullable|string|max:20',
            'id' => 'nullable|integer|exists:appointments,id',
        ]);
    
        // Get parameters
        $createdAtFrom = $request->input('created_at_from');
        $createdAtTo = $request->input('created_at_to');
        $datedFrom = $request->input('dated_from');
        $datedTo = $request->input('dated_to');
        $doctorId = $request->input('doctor_id');
        $clientId = $request->input('client_id');
        $status = $request->input('status');
        $paymentId = $request->input('payment_id');
        $doctorName = $request->input('doctor_name');
        $doctorPhone = $request->input('doctor_phone');
        $clientName = $request->input('client_name');
        $clientPhone = $request->input('client_phone');
        $perPage = $request->input('per_page', 10);
        $id = $request->input('id');
    
        // Build the query
        $query = Appointment::query()->orderBy("id", "desc");
    
        // Filter by id if provided
        if ($id) {
            $query->where('id', $id);
        }
    
        // Filter by created_at range
        if ($createdAtFrom && $createdAtTo) {
            $query->whereBetween('created_at', [$createdAtFrom, $createdAtTo]);
        } elseif ($createdAtFrom) {
            $query->where('created_at', '>=', $createdAtFrom);
        } elseif ($createdAtTo) {
            $query->where('created_at', '<=', $createdAtTo);
        }
    
        // Filter by dated range
        if ($datedFrom && $datedTo) {
            $query->whereBetween('dated', [$datedFrom, $datedTo]);
        } elseif ($datedFrom) {
            $query->where('dated', '>=', $datedFrom);
        } elseif ($datedTo) {
            $query->where('dated', '<=', $datedTo);
        }
    
        // Filter by other parameters
        if ($doctorId) {
            $query->where('doctor_id', $doctorId);
        }
    
        if ($clientId) {
            $query->where('client_id', $clientId);
        }
    
        if ($status) {
            $query->where('status', $status);
        }
    
        if ($paymentId) {
            $query->where('payment_id', 'ilike', "%{$paymentId}%"); // Case-insensitive match
        }
    
        // Case-insensitive search for doctor_name and doctor_phone
        if ($doctorName) {
            $query->whereHas('doctor', function ($q) use ($doctorName) {
                $q->whereRaw("LOWER(CONCAT(first_name, ' ', last_name)) LIKE ?", ['%' . strtolower($doctorName) . '%'])
                  ->orWhereRaw("LOWER(first_name) LIKE ?", ['%' . strtolower($doctorName) . '%'])
                  ->orWhereRaw("LOWER(last_name) LIKE ?", ['%' . strtolower($doctorName) . '%']);
            });
        }
    
        if ($doctorPhone) {
            $query->whereHas('doctor', function ($q) use ($doctorPhone) {
                $q->where('phone', 'like', "%{$doctorPhone}%");
            });
        }
    
        // Case-insensitive search for client_name and client_phone
        if ($clientName) {
            $query->whereHas('client', function ($q) use ($clientName) {
                $q->whereRaw("LOWER(CONCAT(first_name, ' ', last_name)) LIKE ?", ['%' . strtolower($clientName) . '%'])
                  ->orWhereRaw("LOWER(first_name) LIKE ?", ['%' . strtolower($clientName) . '%'])
                  ->orWhereRaw("LOWER(last_name) LIKE ?", ['%' . strtolower($clientName) . '%']);
            });
        }
    
        if ($clientPhone) {
            $query->whereHas('client', function ($q) use ($clientPhone) {
                $q->where('phone', 'like', "%{$clientPhone}%");
            });
        }
    
        // Eager load relationships and paginate
        $appointments = $query->with(['doctor', 'client'])->paginate($perPage);
    
        // Check for export action
        if ($request->has('export')) {
            if ($request->input('export') === 'excel') {
                return $this->exportController->exportAppointmentsExcel($appointments);
            }
        }
    
        // Render the list view
        return view('admin.appointments', compact(
            'appointments', 
            'createdAtFrom', 
            'createdAtTo', 
            'datedFrom', 
            'datedTo', 
            'doctorId', 
            'clientId', 
            'status', 
            'paymentId', 
            'id', 
            'perPage', 
            'doctorName', 
            'doctorPhone', 
            'clientName', 
            'clientPhone'
        ));
    }
    
public function listWithdrawals(Request $request)
{
    // Get the request inputs for filtering
    $transactionId = $request->input('transaction_id');
    $doctorId = $request->input('doctor_id');
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $processed = $request->input('processed');
    $perPage = $request->input('per_page', 10);

    // Initialize the query for withdrawals
    $query = Withdrawal::query()->orderBy("id","desc");;

    // Filter by transaction_id if provided
    if ($transactionId) {
        $query->where('transaction_id', 'like', '%' . $transactionId . '%');
    }

    // Filter by doctor_id if provided
    if ($doctorId) {
        $query->where('doctor_id', $doctorId);
    }

    // Filter by date range (from_date and to_date) if provided
    if ($fromDate && $toDate) {
        $query->whereBetween('created_at', [$fromDate, $toDate]);
    } elseif ($fromDate) {
        $query->where('created_at', '>=', $fromDate);
    } elseif ($toDate) {
        $query->where('created_at', '<=', $toDate);
    }

    // Filter by processed date if provided
    if ($processed) {
        $query->whereDate('updated_at', $processed); // Assuming 'processed' is a date filter
    }

    // Filter by status if provided
    if ($status = $request->input('status')) {
        $query->where('status', $status);
    }

    // Check for export action
    if ($request->has('export') && $request->input('export') === 'excel') {
        $withdrawals = $query->get(); // Retrieve all records for export
        return $this->exportController->exportWithdrawalsExcel($withdrawals); // Assuming exportWithdrawalsExcel() is implemented
    }

    // Paginate the results
    $withdrawals = $query->paginate($perPage);

    // Return the view with the filtered withdrawals
    return view('admin.withdrawal_history', compact(
        'withdrawals', 
        'transactionId', 
        'doctorId', 
        'fromDate', 
        'toDate', 
        'processed', 
        'perPage'
    ));
}
public function updateWithdrawal(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'withdrawal_id' => 'required|exists:withdrawals,id',
        'status' => 'required|string',
        'remarks' => 'nullable|string',
        'transaction_id' => 'nullable|string',
        'file' => 'nullable|file|image|max:2048', // Ensure file is an image and not larger than 2MB
    ]);

    // Find the withdrawal by ID
    $withdrawal = Withdrawal::find($request->withdrawal_id);

    // Check if the withdrawal exists
    if (!$withdrawal) {
        return redirect()->route('admin.withdrawals')->with('error', 'Withdrawal not found.');
    }

    // Update status and remarks
    $withdrawal->status = $request->status;
    $withdrawal->remarks = $request->remarks;

    // Update transaction_id if provided
    if ($request->has('transaction_id')) {
        $withdrawal->transaction_id = $request->transaction_id;
    }

    // Handle file upload if a file is provided
    if ($request->hasFile('file')) {
        // Generate a unique file name
        $file = $request->file('file');
        $uniqueName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Move the file to the withdrawals folder
        $file->move(public_path('withdrawals'), $uniqueName);

        // Save the file name in the database (if applicable)
        $withdrawal->file =  $uniqueName;
    }

    // Save the updated withdrawal record
    $withdrawal->save();

    return redirect()->route('admin.withdrawals')->with('success', 'Withdrawal status updated successfully.');
}


public function walletEntries(Request $request)
{
    $query = Wallet::query()->orderBy("id","desc");

    // Filter by doctor_id
    if ($request->has('doctor_id') && $request->doctor_id) {
        $query->where('doctor_id', $request->doctor_id);
    }

    // Filter by date range
    if ($request->has('from_date') && $request->has('to_date')) {
        if ($request->from_date && $request->to_date) {
        $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }
    }

    // Paginate results
    $wallets = $query->with(['client', 'doctor'])->paginate(10);

    // Export logic
    if ($request->has('export') && $request->input('export') === 'excel') {
        return $this->exportController->exportWalletsExcel($wallets);
    }

    // Return the view for the wallet entries page
    return view('admin.wallets', compact('wallets'));
}


public function incomeEntries(Request $request)
{
    $query = Appointment::query()->orderBy("id","desc");

    // Filter by doctor_id
    if ($request->has('doctor_id') && $request->doctor_id) {
        $query->where('doctor_id', $request->doctor_id);
    }

    // Filter by date range
    if ($request->has('from_date') && $request->has('to_date')) {
        if ($request->from_date && $request->to_date) {
        $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }
    }

    // Paginate results
    $wallets = $query->with(['client', 'doctor'])->paginate(10);

    // Export logic
    if ($request->has('export') && $request->input('export') === 'excel') {
        return $this->exportController->exportIncomesExcel($wallets);
    }

    // Return the view for the wallet entries page
    return view('admin.incomes', compact('wallets'));
}





}
