<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\GalleryController;
use App\Models\Page;
/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::get('/conditions', function () {
    // Fetch the page with name field value 'Conditions'
    $page = Page::where('name', 'Conditions')->first();

    if ($page) {
        return response()->json([
            'status' => 'success',
            'data' => [
                'title' => $page->title,
                'content' => $page->text,
            ],
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Page not found.',
    ], 404);
});
Route::post('/send-otp', [UserController::class, 'sendOtpMobile'])->name('sendOtpMobile');
Route::post('/login', [UserController::class, 'loginMobile'])->name('loginMobile');
Route::post('/register/client', [UserController::class, 'registerClient'])->name('registerClient');
Route::post('/register/doctor', [UserController::class, 'registerDoctor'])->name('registerDoctor');
Route::get('/doctors/{doctor_id}/slots', [SlotController::class, 'getDoctorSlots'])->name('api.doctor.slots');
Route::get('/slots', [SlotController::class, 'index']);
Route::post('/search/doctors', [UserController::class, 'searchDoctorsMobile'])->name('api.search.doctors');
Route::get('/doctor/{id}', [UserController::class, 'doctorDetails'])->name('api.doctor.details');
Route::get('/countries', [LocalityController::class, 'getCountries']);
Route::get('/states', [LocalityController::class, 'getStates']);
Route::get('/cities/{state}', [LocalityController::class, 'getCities']);
Route::get('/allcities', [LocalityController::class, 'getAllCities'])->name('allCities');
Route::get('/all-languages', [LocalityController::class, 'listLanguages']);

Route::get('/available-slots', [AppointmentController::class, 'getAvailableSlots'])->name('getAvailableSlots');
/*
|--------------------------------------------------------------------------
| Protected Routes (Requires Authentication via Sanctum)
|--------------------------------------------------------------------------
*/
// Route to fetch all details (conditions, experiences, languages, galleries) for a specific doctor
Route::get('/doctor/{doctor_id}/details', [DoctorController::class, 'getDoctorConditions']);
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/submit-review', [AppointmentController::class, 'storeReview']);
    Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications');

    Route::delete('/user', [UserController::class, 'destroy']);
    // Common User Routes
    Route::get('/user', [UserController::class, 'getUserDetails'])->name('user.details');
    Route::post('/user/update', [UserController::class, 'updateUser'])->name('user.update');
    Route::post('/logout', [UserController::class, 'logoutMobile'])->name('logoutMobile');
    Route::get('/redirect-dashboard', [UserController::class, 'redirectToDashboardMobile'])->name('redirectDashboard');
   

    Route::post('razorpay/create-order', [RazorpayController::class, 'createOrder']);
    Route::post('razorpay/verify-payment', [RazorpayController::class, 'verifyPayment']);
    // Doctors List and Search
    Route::get('/doctors', [UserController::class, 'doctorList'])->name('api.doctors.list');
   
    
   
    Route::get('/slots/{id}', [SlotController::class, 'show']);
    /*
    
    |--------------------------------------------------------------------------
    | Appointment Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('appointments')->group(function () {
        Route::post('/book', [AppointmentController::class, 'bookAppointment'])->name('appointments.book');
        Route::post('/{id}/cancel', [AppointmentController::class, 'cancelAppointment'])->name('appointments.cancel');
        Route::put('/{id}/update', [AppointmentController::class, 'updateAppointment'])->name('appointments.update'); // Route for updating an appointment
    
        Route::get('/', [AppointmentController::class, 'getAppointments'])->name('appointments.list');
    });
    
    

    /*
    |--------------------------------------------------------------------------
    | Slot Routes (Role-based Access)
    |--------------------------------------------------------------------------
    */
    Route::middleware('doctor')->group(function () {
        Route::post('galleries', [GalleryController::class, 'store']); // for uploading images
        Route::delete('galleries/delete/{id}', [GalleryController::class, 'destroy']); // for deleting images
        Route::get('/dashboard', [AppointmentController::class, 'doctorDashboard'])->name('doctorDashboard');
        // Route to update or save all data (conditions, experiences, languages, galleries) in one request
        Route::post('/doctor/update', [UserController::class, 'updateUser'])->name('doctor.update');
Route::post('/doctor/update-data', [UserController::class, 'updateDoctorData']);
        Route::post('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('updateAppointment');
        Route::get('/banks', [BankController::class, 'index'])->name('banks.index');
        Route::post('/banks', [BankController::class, 'store'])->name('banks.store');
        Route::put('/banks/{id}', [BankController::class, 'update'])->name('banks.update');
        Route::delete('/banks/{id}', [BankController::class, 'destroy'])->name('banks.destroy');
        Route::post('/withdraw', [WithdrawalController::class, 'store'])->name('withdraw');
        Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals');

        Route::post('/slots', [SlotController::class, 'store']);
        
        Route::put('/slots/{id}', [SlotController::class, 'update']);
        Route::delete('/slots/{id}', [SlotController::class, 'destroy']);
        /*
    |--------------------------------------------------------------------------
    | Wallet Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('wallet')->group(function () {
        Route::get('/', [WalletController::class, 'index'])->name('wallet.details');
        Route::post('/add-funds', [WalletController::class, 'addFunds'])->name('wallet.addFunds');
        Route::post('/withdraw', [WalletController::class, 'withdrawFunds'])->name('wallet.withdraw');
    });
    });
});
/*
# Public Routes (No Authentication Required)
POST   https://easygo.stgserver.site/api/send-otp                  # Sends OTP for mobile verification
POST   https://easygo.stgserver.site/api/login                     # User login (mobile)
POST   https://easygo.stgserver.site/api/register/client           # Client registration
POST   https://easygo.stgserver.site/api/register/doctor           # Doctor registration
GET    https://easygo.stgserver.site/api/doctors/{doctor_id}/slots # Get available slots for a specific doctor
GET    https://easygo.stgserver.site/api/slots                     # Get all slots (general list)
POST   https://easygo.stgserver.site/api/search/doctors            # Search for doctors by city, locality, and specialty
GET    https://easygo.stgserver.site/api/doctor/{id}               # Get details of a specific doctor
GET    https://easygo.stgserver.site/api/countries                 # Get the list of countries
GET    https://easygo.stgserver.site/api/states/{country}          # Get the list of states for a country
GET    https://easygo.stgserver.site/api/cities/{state}            # Get the list of cities for a state

# Protected Routes (Requires Authentication via Sanctum)

## Common User Routes
GET    https://easygo.stgserver.site/api/user                       # Get the authenticated user's details
POST   https://easygo.stgserver.site/api/user/update                # Update the authenticated user's details
POST   https://easygo.stgserver.site/api/logout                     # Log out the authenticated user
GET    https://easygo.stgserver.site/api/redirect-dashboard         # Redirect the authenticated user to the appropriate dashboard

## Doctor Routes
GET    https://easygo.stgserver.site/api/doctors                    # Get a list of all doctors
POST   https://easygo.stgserver.site/api/slots                      # Create a new slot (requires doctor role)
PUT    https://easygo.stgserver.site/api/slots/{id}                 # Update an existing slot (requires doctor role)
DELETE https://easygo.stgserver.site/api/slots/{id}                 # Delete a slot (requires doctor role)
GET    https://easygo.stgserver.site/api/slots/{id}                 # Get details of a specific slot

## Appointment Routes
POST   https://easygo.stgserver.site/api/appointments/book          # Book a new appointment (requires client role)
POST   https://easygo.stgserver.site/api/appointments/{id}/cancel   # Cancel an appointment (requires client role)
PUT    https://easygo.stgserver.site/api/appointments/{id}/update   # Update an appointment's details (requires client role)
GET    https://easygo.stgserver.site/api/appointments               # Get all appointments (client or doctor role)
POST   https://easygo.stgserver.site/api/appointments/{id}/update-status 
# Allows a doctor to accept, reject, or complete an appointment

## Wallet Routes
GET    https://easygo.stgserver.site/api/wallet                     # Get wallet balance and transaction history
POST   https://easygo.stgserver.site/api/wallet/add-funds           # Add funds to the wallet
POST   https://easygo.stgserver.site/api/wallet/withdraw            # Withdraw funds from the wallet

## Bank Management (Doctor Role Required)
GET    https://easygo.stgserver.site/api/banks                      # Get a list of linked banks
POST   https://easygo.stgserver.site/api/banks                      # Add a new bank
PUT    https://easygo.stgserver.site/api/banks/{id}                 # Update details of an existing bank
DELETE https://easygo.stgserver.site/api/banks/{id}                 # Remove a linked bank

## Withdrawal Management (Doctor Role Required)
POST   https://easygo.stgserver.site/api/withdraw                   # Request a withdrawal from wallet balance
GET    https://easygo.stgserver.site/api/withdrawals                # View withdrawal history
*/
