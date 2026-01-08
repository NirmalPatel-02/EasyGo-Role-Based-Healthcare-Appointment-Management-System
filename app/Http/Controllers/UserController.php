<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str; 
use App\Models\User;
use App\Models\Speciality;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Condition;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Gallery;
use App\Models\Certificate;
use App\Models\Review;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function loginView()
    {
        Auth::logout();
        return view('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function redirectToDashboard()
    {
        $user = Auth::user();
        if ($user->role === 'client') {
            return route('index');
        } elseif ($user->role === 'doctor') {
            return route('doctorDashboard');
        } elseif ($user->role === 'admin') {
            return route('adminDashboard');
        }
    }
    
    public function sendOtpMobile(Request $request)
    {
        $phone = $request->input('phone');
        $action = $request->input('action');
    
        // Custom validation handling
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10',
            'action' => 'required|in:login,register',
        ]);
    
        // If validation fails, return response with 200 status
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 200);
        }
    
        // Check the environment (localhost or production)
        if (app()->environment('local')) {
            // If local environment, use fixed OTP '1234'
            $otp = 1234;
            $expiryTime = now()->addMinutes(1); // OTP valid for 1 minute
        } else {
            // If live environment, generate random OTP
            $otp = rand(1000, 9999);
            $expiryTime = now()->addMinutes(1); // OTP valid for 1 minute
        }
    
        if ($action === 'login') {
            // Check if the user exists
            $user = User::where('phone', $phone)->first();
    
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found with this phone number.'
                ], 200);
            }
    
            // Update user record with OTP and expiry
            $user->otp = $otp;
            $user->otp_expiry = $expiryTime;
            $user->save();
        } elseif ($action === 'register') {
            // Check if the phone number is already registered
            $userExists = User::where('phone', $phone)->exists();
    
            if ($userExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Phone number already registered.'
                ], 200);
            }
    
            // Store OTP and expiry for registration
            DB::table('otps')->updateOrInsert(
                ['phone' => $phone], // Ensure one entry per phone
                ['otp' => $otp, 'otp_expiry' => $expiryTime, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    
        // Send OTP using Twilio (only on live environment)
        if (!app()->environment('local')) {
            $resp = $this->sendSmsWithTwilio("+91" . $phone, $otp);
            if ($resp !== "success") {
                return response()->json([
                    'success' => false,
                    'message' => 'Error sending OTP: ' . $resp,
                ], 200);
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.',
            'expiry' => $expiryTime->toDateTimeString()
        ]);
    }
    
    
    /**
     * Send OTP via Twilio SMS
     */
    protected function sendSmsWithTwilio($phone, $otp)
    {
        // Twilio Account SID and Auth Token
        // $accountSid = env('TWILIO_SID');
        // $authToken = '5afe64c5df8d006c20e457612ad1bdde';

        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN'); // Change this line
        $twilioNumber = env('TWILIO_PHONE_NUMBER');
        // Twilio API URL
        $url = "https://api.twilio.com/2010-04-01/Accounts/$accountSid/Messages.json";

        // The data to be sent in the request
        $data = [
            'To' => $phone,        // Recipient's phone number
            'From' => '+19379322454',       // Your Twilio phone number
            'Body' => 'Your Easygo OTP is : '.$otp.'! expiring in 1 minute' // SMS body
        ];

       
    
        
            $ch = curl_init($url);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_USERPWD, "$accountSid:$authToken");
    
            // Execute cURL request
            $response = curl_exec($ch);
        
            // Check for errors
            if (curl_errno($ch)) {
                return 'Error:' . curl_error($ch);
            } else {
                return "success";
            }
        
    }

 public function loginMobile(Request $request)
{
    // Validate the phone number and single 4-digit OTP
    $request->validate([
        'phone' => 'required|numeric|digits:10',
        'otp' => 'required|numeric|digits:4'
    ]);

    // Check if the user exists with the provided phone number
    $user = User::where('phone', $request->input('phone'))->first();
    if($user->status==="Blocked")
    {
        return response()->json([
            'success' => false,
            'message' => 'Your account is suspended. Contact administration for more information'
        ], 200);  
    }
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Account does not exist with this phone number.'
        ], 200);
    }

    // Verify OTP and check if it has expired
    $otpInput = $request->input('otp');
    if ($otpInput != $user->otp || Carbon::now()->gt(Carbon::parse($user->otp_expiry))) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid or expired OTP.'
        ], 200);
    }

    // OTP is valid, log the user in
    Auth::login($user);

    // Generate an API token for mobile use
    $token = $user->createToken('MobileApp')->plainTextToken;

    // Determine the redirect URL based on user role
    $redirectTo = $user->role === 'doctor' 
        ? $this->redirectToDashboard() 
        : route('bookAppointment'); // Default redirect if no intended URL

    // Check if the intended URL exists in the session
    if (session()->has('url.intended')) {
        $redirectTo = session('url.intended'); // Set redirect URL from session
        session()->forget('url.intended'); // Remove the session value after use
    }
    else {
        
        $redirectTo=$this->redirectToDashboard() ;
    }

    return response()->json([
        'success' => true,
        'message' => 'Login successful.',
        'token' => $token,
        'id' => $user->id,
        'user' => $user,
        'redirect_to' => $redirectTo
    ]);
}

    public function registerClient(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|numeric|regex:/^[0-9]{10}$/',
        'otp' => 'required|numeric|digits:4',
    ]);

    $phone = $request->input('phone');
    $otpInput = $request->input('otp');

    // Validate OTP
    $otpRecord = DB::table('otps')->where('phone', $phone)->first();
    if (!$otpRecord || $otpInput != $otpRecord->otp || now()->greaterThan($otpRecord->otp_expiry)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid or expired OTP.',
        ], 400); // Correctly set the HTTP status code.
    }

    // Register the user
    $newUser = User::create([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'phone' => $phone,
        'role' => 'client',
    ]);

    // Delete OTP after successful validation
    DB::table('otps')->where('phone', $phone)->delete();

    Auth::login($newUser);
    $token = $newUser->createToken('MobileApp')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Registration successful.',
        'token' => $token,
        'user' => $newUser,
        'redirect_to' =>"/"
    ], 200); // Correctly set the HTTP status code.
}
public function registerDoctor(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|numeric|regex:/^[0-9]{10}$/',
        'otp' => 'required|numeric|digits:4',
    ]);

    $phone = $request->input('phone');
    $otpInput = $request->input('otp');

    // Validate OTP
    $otpRecord = DB::table('otps')->where('phone', $phone)->first();
    if (!$otpRecord || $otpInput != $otpRecord->otp || now()->greaterThan($otpRecord->otp_expiry)) {
        return response()->json([
            'success' => false,
            'status_code' => 400,
            'message' => 'Invalid or expired OTP.',
        ], 400);
    }

    // Fetch commission rate from settings
    $rate = DB::table('settings')->value('commission_rate'); // Corrected

    // Register the doctor
    $newUser = User::create([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'phone' => $phone,
        'role' => 'doctor',
        'status' => 'Pending',
        'commission_rate' => $rate, // Corrected
    ]);

    // Delete OTP after successful validation
    DB::table('otps')->where('phone', $phone)->delete();

    Auth::login($newUser);
    $token = $newUser->createToken('MobileApp')->plainTextToken;

    return response()->json([
        'success' => true,
        'status_code' => 200,
        'message' => 'Registration successful.',
        'token' => $token,
        'user' => $newUser,
        'redirect_to' => "/doctor-dashboard",
    ], 200);
}

    
    

    public function logoutMobile(Request $request)
    {
        // Revoke all tokens for the logged-in user
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['success' => true, 'message' => 'Logged out successfully.']);
    }
    public function redirectToDashboardMobile()
    {
        $user = Auth::user();
        if ($user->role === 'client') {
            return route('clientDashboard'); // Adjust this based on your routing
        } elseif ($user->role === 'doctor') {
            return route('doctorDashboard');
        }
         
         return "index";
    }
    public function viewProfile(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();
    
        // Check if the user is authenticated
        if ($user) {
            // Check if the request expects a JSON response
            if ($request->expectsJson()) {
                // For API requests, send a JSON response with user data
                return response()->json([
                    'success' => true,
                    'user' => $user,
                ], 200);
            }
            $specialities = Speciality::pluck('title');
        $conditions = Condition::where('doctor_id',$user->id)->pluck('value');
        $experiences = DB::table('experiences')->where('doctor_id',$user->id)->get();
        $certificates = DB::table('certificates')->where('doctor_id',$user->id)->get();
        $languages = DB::table("languages")->where('doctor_id',$user->id)->get()->toArray();
        
        $galleries = DB::table('galleries')->where('doctor_id',$user->id)->get();
           $alllanguages= DB::table('alllanguages')->pluck('name');

            
            // For web requests (standard browser request), redirect accordingly
            if ($user->role == 'doctor') {
                return view('doctor-dashboard.profile',compact('user','specialities','alllanguages','conditions','experiences','galleries','certificates','languages'));
            } elseif ($user->role == 'client') {
                return view('manage_profile')->with('user', $user);
            }
        }
    }
    public function getUserDetails(Request $request)
{
    // Retrieve the authenticated user
    $user = Auth::user();

    // Check if the user is authenticated
         // Fetch unique specialties
        
        
         $alllanguages= DB::table('alllanguages')->pluck('name');
         $states = DB::table('states')->where('country_id', 101)->get();

         // Fetch cities from these states
         $cities = DB::table('cities')->whereIn('state_id', $states->pluck('id'))->get();
    if ($user) {
        $specialities = Speciality::pluck('title');
        $conditions = DB::table('conditions')->where('doctor_id',$user->id)->pluck('value');
        $experiences = DB::table('experiences')->where('doctor_id',$user->id)->get();
        $certificates = DB::table('certificates')->where('doctor_id',$user->id)->get();
        $languages = DB::table("languages")->where('doctor_id',$user->id)->get()->toArray();
        if($user->role==="client")
        $reviews = DB::table("reviews")->where('client_id',$user->id)->where('status','Approved')->get()->toArray();
        else 
        $reviews = DB::table("reviews")->where('doctor_id',$user->id)->where('status','Approved')->get()->toArray();
        $galleries = DB::table('galleries')->where('doctor_id',$user->id)->get();
        // Check if the request expects a JSON response
        if ($request->expectsJson()) {
            // For API requests, send a JSON response with user data
            return response()->json([
                'success' => true,
                'user' => $user,
                'specialities' => $specialities,
                'languages' => $languages,
                'experiences' => $experiences,
                'conditions' => $conditions,
                'galleries' => $galleries,
                'certificates' => $certificates,
                'reviews' => $reviews,
                
            ], 200);
        }
    
        
        // For web requests (standard browser request), redirect accordingly
        if ($user->role == 'doctor') {
            return view('doctor-dashboard.editprofile',compact('user','specialities','alllanguages','conditions','experiences','galleries','certificates','languages','cities','states','reviews'));
        } elseif ($user->role == 'client') {
            return view('profile',compact('user','reviews'));
        }

        // Default return for invalid roles
        return response()->json([
            'success' => false,
            'specialities' => $specialities,
            'languages' => $languages,
            'experiences' => $experiences,
            'conditions' => $conditions,
            'galleries' => $galleries,
            'certificates' => $certificates,
            'reviews' => $reviews,
            'message' => 'User role not found.',
        ], 404);
    }

    // If no user found, return an error response for both API and web requests
    if ($request->expectsJson()) {
        return response()->json([
            'success' => false,
            'specialities' => $specialities,
            'languages' => $languages,
            'experiences' => $experiences,
            'conditions' => $conditions,
            'galleries' => $galleries,
            'certificates' => $certificates,
            'message' => 'User not authenticated',
        ], 200);
    }

    // For web requests, return an error page or redirect to login
    return redirect()->route('login')->withErrors('User not authenticated');
}
public function updateUser(Request $request)
{
    $currentUser = auth()->user();
$user = $currentUser;

if ($currentUser->role === 'admin' && $request->has('user_id')) {
    $user = User::findOrFail($request->input('user_id'));
}

$allowedFields = [
    'first_name' => 'nullable|string|max:255',
    'last_name' => 'nullable|string|max:255',
    'email' => 'nullable|email|max:255',
    'password' => 'nullable|string|min:6',
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
    'education' => 'nullable|string|max:255',
    'bio' => 'nullable|string|max:500',
    'certification_name' => 'nullable|string|max:255',
    'certified_by' => 'nullable|string|max:255',
    'completion_date' => 'nullable|date',
    'price' => 'nullable|numeric|min:1',
    'latitude'=>'nullable|string',
    'longitude'=>'nullable|string'
];

if ($user->role === 'client') {
    $allowedFields = array_intersect_key($allowedFields, array_flip([
        'first_name', 'last_name', 'email',  'avatar', 'dob', 'gender',
        'city', 'locality', 'country', 'state', 'zipcode', 'language', 'bio',
    ]));
}

// Check if the provided email is the same as the current user's email
if ($request->has('email') && $request->input('email') === $user->email) {
    // Remove email field from the validation rules
    unset($allowedFields['email']);
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

    if ($user->role === 'doctor' && $request->hasAny(['city', 'state', 'country', 'latitude', 'longitude'])) {
        // Validate latitude
        if ($request->filled('latitude') && is_numeric($request->latitude) && 
            $request->latitude >= -90 && $request->latitude <= 90) {
            $validatedData['latitude'] = $request->latitude;
        } else {
            $validatedData['latitude'] = $user->latitude; // Retain the current value
        }
    
        // Validate longitude
        if ($request->filled('longitude') && is_numeric($request->longitude) && 
            $request->longitude >= -180 && $request->longitude <= 180) {
            $validatedData['longitude'] = $request->longitude;
        } else {
            $validatedData['longitude'] = $user->longitude; // Retain the current value
        }
    
        // Update status for non-admin users
        if ($currentUser->role !== 'admin') {
            $validatedData['status'] = 'Pending';
        }
    }
    

    if ($currentUser->role === 'admin' && $request->has('status')) {
        $validatedData['status'] = $request->input('status');
    }

    $user->update($validatedData);
    $doctorUpdateResponse ="";
    if ($user->role === 'doctor' && $request->hasAny(['conditions', 'experiences', 'languages', 'galleries', 'certificates'])) {
        $doctorUpdateResponse = $this->updateDoctorData($request);

        
    }

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'User details updated successfully!' ,
            'user' => $user,
        ], 200);
    }

    $redirectRoute = ($user->role === 'client') ? 'client.profile' : 'doctor.profile';
    return redirect()->back()->with('success', 'Your details updated successfully!');
}

/**
 * Update all doctor-related data (from previous method).
 */
public function updateDoctorData(Request $request)
{
    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'conditions' => 'nullable|array',
        'conditions.*.value' => 'required|string',
        'certificates' => 'nullable|array',
        
        'experiences' => 'nullable|array',
        'experiences.*.name' => 'required|string',
        'experiences.*.from' => 'required|date',
        'experiences.*.to' => 'required|date',
        'languages' => 'nullable|array',
        'languages.*.name' => 'required|string',
        'galleries' => 'nullable|array|max:4',
        'galleries.*' => 'required|image|max:2048',
    ]);

    if ($validator->fails()) {
        // Return validation errors to the calling method
        return [
            'success' => false,
            'errors' => $validator->errors(),
        ];
    }

    try {
        $doctorId = Auth::user()->id;
    
        // Update conditions
        if ($request->has('conditions')) {
            Condition::where('doctor_id', $doctorId)->delete();
            if (!empty($request->input('conditions'))) {
                foreach ($request->input('conditions') as $condition) {
                    Condition::create([
                        'doctor_id' => $doctorId,
                        'value' => $condition['value'],
                    ]);
                }
            }
        }
    
        // Update experiences
        if ($request->has('experiences')) {
            Experience::where('doctor_id', $doctorId)->delete();
            if (!empty($request->input('experiences'))) {
                foreach ($request->input('experiences') as $experience) {
                    Experience::create([
                        'doctor_id' => $doctorId,
                        'name' => $experience['name'],
                        'from' => $experience['from'],
                        'to' => $experience['to'],
                    ]);
                }
            }
        }
    
        // Update languages
        if ($request->has('languages')) {
            Language::where('doctor_id', $doctorId)->delete();
            if (!empty($request->input('languages'))) {
                foreach ($request->input('languages') as $language) {
                    Language::create([
                        'doctor_id' => $doctorId,
                        'name' => $language['name'],
                    ]);
                }
            }
        }
    
        // Update galleries
        if ($request->hasFile('galleries')) {
            Gallery::where('doctor_id', $doctorId)->delete();
            foreach (array_slice($request->file('galleries'), 0, 4) as $imageFile) {
                $imageFilename = Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('galleries'), $imageFilename);
    
                Gallery::create([
                    'doctor_id' => $doctorId,
                    'name' => $imageFilename,
                ]);
            }
        }
    
        // Update certificates
        if ($request->has('certificates')) {
            foreach ($request->input('certificates') as $index => $certificate) {
                if ($certificate['is_new'] == 1) {
                    $certificateFile = $request->file("certificates.{$index}.file");
                    if ($certificateFile) {
                        $certificateFilename = Str::uuid() . '.' . $certificateFile->getClientOriginalExtension();
                        $certificateFile->move(public_path('certificates'), $certificateFilename);
    
                        Certificate::create([
                            'doctor_id' => $doctorId,
                            'name' => $certificate['name'],
                            'by' => $certificate['by'],
                            'file' => $certificateFilename,
                        ]);
                    }
                }
            }
        }
    
        return [
            'success' => true,
            'message' => 'Doctor data updated successfully!',
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage(),
        ];
    }
     catch (\Throwable $e) {
        // Log the error for debugging
        \Log::error('Error updating doctor data: ', ['error' => $e->getMessage()]);

        return [
            'success' => false,
            'message' => 'An error occurred while updating doctor data.',
            'error' => $e->getMessage(),
        ];
    }
}







     public function doctorDetails(Request $request, $id)
     {
         // Fetching the complete user data for the doctor
         $doctor = User::where('id', $id)->where('role', 'doctor')->first();
 
         // If doctor not found, return an error response
         if (!$doctor) {
             $response = ['error' => 'Doctor not found'];
             return $request->expectsJson() 
                 ? response()->json($response, 200) 
                 : redirect()->route('index')->with('error', 'Doctor not found');
         }
 
         // Returning complete user data (all columns) for the doctor
         $response = $doctor->toArray(); // Convert the complete user model to an array
 
         // Check if the request expects JSON (API) or view (Web)
         return $request->expectsJson() 
             ? response()->json($response, 200) 
             : view('doctor_details', ['doctor' => $response]);
     }
 
     /**
      * Get a list of doctors (complete user data)
      * Handles both API and Web access
      */
      public function doctorList(Request $request)
{
    // Redirect doctors to their dashboard for web requests, or send a JSON response for API calls
    if (auth()->check() && auth()->user()->role === 'doctor') {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Redirect to doctor dashboard.',
                'redirect_url' => route('doctorDashboard'),
            ], 200);
        }
        return redirect()->route('doctorDashboard');
    }

    // Initialize the query to fetch doctors
    $doctorsQuery = User::where('role', 'doctor');

    // Apply status filter for admin users only
    if (auth()->check() && auth()->user()->role === 'admin') {
        if ($request->has('status')) {
            $doctorsQuery->where('status', $request->input('status'));
        }
    } else {
        // For non-admin users, fetch only approved doctors
        $doctorsQuery->where('status', 'Approved');
    }

    // Paginate the results
    $doctors = $doctorsQuery->paginate(10);

    $specialities = Speciality::pluck('title');

    // Handle JSON response
    if ($request->expectsJson()) {
        return response()->json([
            'doctors' => $doctors,
            'specialities' => $specialities,
        ], 200);
    }

    // Return the view with doctors and specialities
    if (auth()->check() && auth()->user()->role === 'admin') {
        return view('admin.doctors', compact('doctors', 'specialities'));
    } else {
        return view('index', compact('doctors', 'specialities'));
    }
}
public function searchDoctors(Request $request)
{
    $query = User::where('role', 'doctor');

  // Apply city filter if provided
if ($request->has('city')) {
    // dd($request->city);
    $query->whereRaw('LOWER(city) LIKE ?', ['%' . strtolower($request->city) . '%']);
}

// dd($query->get());
    // If locality is provided, use latitude and longitude for proximity search
    if ($request->has('longitude')) {
        $userLatitude = $request->latitude ?? 0;
        $userLongitude = $request->longitude ?? 0;
      
        $radius = $request->get('radius', 50);
     if($userLatitude && $userLongitude) {
        $query->selectRaw(
          "*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
            * cos(radians(longitude) - radians(?)) + sin(radians(?)) 
            * sin(radians(latitude)))) AS distance",
          [$userLatitude, $userLongitude, $userLatitude]
        )
        ->having('distance', '<=', $radius)
        ->orderBy('distance', 'asc');
     }
      }
    // Apply speciality filter if provided
    if ($request->has('speciality')) {
        $query->where('speciality', 'like', '%' . $request->speciality . '%');
    }

    // Apply gender filter if provided (and not 'all')
    if ($request->has('gender') && $request->gender !== 'all') {
        $query->where('gender', $request->gender);
    }

    // Ensure the doctors have an 'Approved' status
    $query->where('status', 'Approved');

    // Apply price sorting if provided
    if ($request->has('sort_price') && in_array($request->sort_price, ['asc', 'desc'])) {
        $query->orderBy('price', $request->sort_price);  // Sort by price: low to high or high to low
    }

    // If no filters are provided, use IP location with a radius of 150 km
    if (!$request->has('city') && !$request->has('locality') && !$request->has('speciality') && !$request->has('gender')) {
        $ip = request()->ip(); // Get client IP
        $response = Http::get("http://ip-api.com/json/{$ip}");

        if ($response->successful()) {
            $data = $response->json();
            if ($data["status"] !== "fail") {
                $userLatitude = $data["lat"];
                $userLongitude = $data["lon"];
                $radius = 150;

                $query->selectRaw(
                    "*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
                    * cos(radians(longitude) - radians(?)) + sin(radians(?)) 
                    * sin(radians(latitude)))) AS distance",
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->having('distance', '<=', $radius)
                ->orderBy('distance', 'asc');
            }
        }
    }

    // Fetch doctors based on the search criteria
    $doctors = $query->paginate(10);
    
    // Fetch all specialities
    $specialities = Speciality::pluck('title');

    // Transform doctors collection to include additional information
    $doctors->getCollection()->transform(function ($doctor) use ($request) {
        $doctor->id_sha1 = sha1($doctor->id);
        $doctor->distance = $doctor->distance ?? null;
        $doctor->conditions = Condition::where('doctor_id', $doctor->id)->pluck('value');
        $doctor->experiences = Experience::where('doctor_id', $doctor->id)->get();
        $doctor->languages = Language::where('doctor_id', $doctor->id)->get();
        $doctor->galleries = Gallery::where('doctor_id', $doctor->id)->get();
        $doctor->certificates = Certificate::where('doctor_id', $doctor->id)->get();
        $doctor->reviews = Review::where('doctor_id', $doctor->id)->where('status', 'Approved')->get();
        $doctor->next_available_slot = $this->getNextAvailableSlot($doctor, $request);

        return $doctor;
    });

    $settings = DB::table('settings')->get()->toArray();

    // Return the response as JSON or a view depending on the request type
    if ($request->expectsJson()) {
        return response()->json([
            'doctors' => $doctors,
            'settings' => $settings,
            'specialities' => $specialities,
        ], 200);
    }

    $locality = $request->locality;
    $city = $request->city;

    return view('index', compact('doctors', 'specialities', 'city', 'locality'));
}



  
private function getNextAvailableSlot($doctor, $request)
{
    // Ensure the doctor_id and date are available
    $date = Carbon::today()->format('Y-m-d'); // Default to current date
    
    // Fetch available slots for the doctor on the current date
    $availableSlots = DB::table('slots')
        ->where('doctor_id', $doctor->id)
        ->pluck('time_slot')
        ->toArray();

    $bookedAppointments = DB::table('appointments')
        ->where('doctor_id', $doctor->id)
        ->where('dated', 'LIKE', '%' . $date . '%')
        ->whereIn('status', ['Pending', 'Confirmed'])
        ->pluck('time_slot')
        ->toArray();

    // Get the not booked slots
    $notBookedSlots = array_diff($availableSlots, $bookedAppointments);

    if (empty($notBookedSlots)) {
        // If no slots are available today, check for the next available day
        $date = Carbon::tomorrow()->format('Y-m-d');
        $availableSlots = DB::table('slots')
            ->where('doctor_id', $doctor->id)
            ->pluck('time_slot')
            ->toArray();

        $bookedAppointments = DB::table('appointments')
            ->where('doctor_id', $doctor->id)
            ->where('dated', 'LIKE', '%' . $date . '%')
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->pluck('time_slot')
            ->toArray();

        $notBookedSlots = array_diff($availableSlots, $bookedAppointments);
    }

    // If there are available slots, get the next available slot
    if (!empty($notBookedSlots)) {
        // Assuming time slots are sorted in ascending order
        $nextAvailableSlot = reset($notBookedSlots);

        // Format the date and time slot for the response
        $slotTime = Carbon::createFromFormat('h:i A', $nextAvailableSlot)->format('h:i A');
        $dayOfWeek = Carbon::createFromFormat('Y-m-d', $date)->format('D'); // Get the day of the week abbreviation (e.g., MON, TUE, etc.)

        // Return the formatted next available slot
        return "Next Available Slot: {$slotTime}, {$dayOfWeek}";
    }

    return "No Slots Available"; // Return null if no slots are available
}

      
public function searchDoctorsMobile(Request $request)
{
    // Initialize the query to fetch doctors with the role 'doctor'
    $query = User::where('role', 'doctor')->where('status','like','Approved');

   // Check if the search field is present
if ($request->has('search')) {
    $searchTerm = $request->input('search');
    $query->where(function ($q) use ($searchTerm) {
        $terms = explode(' ', $searchTerm); // Split the search term into individual words

        // Search for each individual term in relevant fields
        foreach ($terms as $term) {
            $q->orWhere(function ($subQuery) use ($term) {
                $subQuery->where('first_name', 'like', '%' . $term . '%')
                         ->orWhere('last_name', 'like', '%' . $term . '%')
                         ->orWhere('city', 'like', '%' . $term . '%')
                         ->orWhere('locality', 'like', '%' . $term . '%')
                         ->orWhere('speciality', 'like', '%' . $term . '%'); // Add any other relevant fields
            });
        }

        // Additionally, search for the combined first_name and last_name
        $q->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $searchTerm . '%']);
    });
}


    // Check if nearby logic should be applied
    if ($request->has(['latitude', 'longitude'])) {
        $userLatitude = $request->latitude;
        $userLongitude = $request->longitude;

        // Define the radius in kilometers (default: 10 km)
        $radius = $request->get('radius', 50);

        // Add a proximity filter using Haversine formula
        $query->selectRaw(
            "*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
            * cos(radians(longitude) - radians(?)) + sin(radians(?)) 
            * sin(radians(latitude)))) AS distance",
            [$userLatitude, $userLongitude, $userLatitude]
        )
        ->having('distance', '<=', $radius)
        ->orderBy('distance', 'asc');
    }

    // Filter by time_slot
    if ($request->has('time_slot')) {
        $timeSlot = $request->time_slot;
        $date = $request->date;

        $query->whereNotIn('id', function ($subQuery) use ($timeSlot, $date) {
            $subQuery->select('doctor_id')
                ->from('appointments')
                ->where('time_slot', $timeSlot)
                ->where('dated', 'LIKE', '%' . $date . '%')
                ->whereIn('status', ['Pending', 'Confirmed']);
        });
    }

    // Filter by price range
    if ($request->has(['price_min', 'price_max'])) {
        $priceMin = $request->price_min;
        $priceMax = $request->price_max;

        $query->whereBetween('price', [$priceMin, $priceMax]);
    }

    // Filter by gender (case insensitive)
    if ($request->has('gender')) {
        $gender = strtolower($request->gender);
        $query->whereRaw('LOWER(gender) = ?', [$gender]);
    }

    // Fetch the filtered results
    $doctors = $query->get();
    $specialities = Speciality::pluck('title');

    // Include all related data
    $doctors->transform(function ($doctor) use ($request) {
        $doctor->id_sha1 = sha1($doctor->id);
        $doctor->distance = $doctor->distance;
        $doctor->conditions = Condition::where('doctor_id', $doctor->id)->pluck('value');
        $doctor->experiences = Experience::where('doctor_id', $doctor->id)->get();
        $doctor->languages = Language::where('doctor_id', $doctor->id)->get();
        $doctor->galleries = Gallery::where('doctor_id', $doctor->id)->get();
        $doctor->certificates = Certificate::where('doctor_id', $doctor->id)->get();
        $doctor->reviews = Review::where('doctor_id', $doctor->id)->where('status','Approved')->get();
        // Calculate not booked slots inline
        if ($request->has('date')) {
            $availableSlots = DB::table('slots')
                ->where('doctor_id', $doctor->id)
                ->pluck('time_slot')
                ->toArray();

            $bookedAppointments = DB::table('appointments')
                ->where('doctor_id', $doctor->id)
                ->where('dated', 'LIKE', '%' . $request->date . '%')
                ->whereIn('status', ['Pending', 'Confirmed'])
                ->pluck('time_slot')
                ->toArray();

            $doctor->not_booked_slots = array_diff($availableSlots, $bookedAppointments);
        }
        else 
        {
            $availableSlots = DB::table('slots')
            ->where('doctor_id', $doctor->id)
            ->pluck('time_slot')
            ->toArray();

            $bookedAppointments = DB::table('appointments')
                ->where('doctor_id', $doctor->id)
                ->whereIn('status', ['Pending', 'Confirmed'])
                ->pluck('time_slot')
                ->toArray();

            $doctor->not_booked_slots = array_diff($availableSlots, $bookedAppointments);
        }

        $doctor->next_available_slot = $this->getNextAvailableSlot($doctor, $request);
        return $doctor;
    });
    $settings = DB::table('settings')->get()->toArray();
    $response = [
        'success' => true,
        'data' => $doctors,
        'settings'=>$settings,
        'specialities' => $specialities
    ];

    return $request->expectsJson() 
        ? response()->json($response, 200) 
        : view('doctor_list', ['doctors' => $doctors]);
}


  
public function getCoordinates($address)
{
    $apiKey = 'AIzaSyAkVY54ZKvhxyMy9fJzcK2LS1uIUxVdwEU';
    $address = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";
    $response = file_get_contents($url);
    $data = json_decode($response);

    if ($data->status == 'OK') {
        $location = $data->results[0]->geometry->location;
        return ['lat' => $location->lat, 'lng' => $location->lng];
    }

    return null;
}




 /**
 * Soft delete the authenticated user's account by updating their data.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy(Request $request)
{
    $user = Auth::user();

    if ($user) {
        // Update user data to "Deleted"
        $user->update([
            'first_name' => 'Deleted',
            'last_name' => 'Deleted',
            'email' => 'Deleted_' . $user->id . '@example.com', // Ensure email uniqueness
            'phone' => 'Deleted_' . $user->id, // Ensure phone uniqueness
            'avatar'=>'avatar.png',
            'status'=>'Deleted'
        ]);

        // Revoke tokens (if using Sanctum or Passport)
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Account data has been marked as deleted.'
        ], 200);
    }

    return response()->json([
        'message' => 'User not found.'
    ], 404);
}
public function notifications(Request $request)
{
    $user = Auth::user();

    // Check if user is authenticated
    if (!$user) {
        // Return response based on request type
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 401); // 401 Unauthorized
        }
        return null; // Web request, return null
    }

    $query = Notification::query();

    // Filter notifications based on user's role
    if ($user->role === 'doctor') {
        $query->where('doctor_id', $user->id);
    } elseif ($user->role === 'client') {
        $query->where('client_id', $user->id);
    } else {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid role.'
            ], 403); // 403 Forbidden
        }
        return null; // Web request, return null
    }

    // Apply status filter if provided in the request
    if ($request->has('status')) {
        $query->where('status', $request->input('status'));
    }

    // Fetch notifications
    $notifications = $query->get();

    // Return response based on request type
    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Notifications retrieved successfully.',
            'notifications' => $notifications,
        ], 200); // 200 OK
    }

    return $notifications; // Web request, return notifications
}



}