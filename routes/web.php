<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminAuthController;


use App\Http\Controllers\RazorpayController;
/*
|----------------------------------------------------------------------
| Public Routes (No Authentication Required)
|----------------------------------------------------------------------
*/

Route::post('/contact-submit', [LocalityController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/contact-us', fn () => view('contact'))->name('contact');
Route::get('/get-city', [LocalityController::class, 'getCity']);

Route::get('/', [UserController::class, 'searchDoctors'])->name('index');
Route::post('/search', [UserController::class, 'searchDoctors'])->name('searchDoctors');
Route::get('/search', [UserController::class, 'searchDoctors'])->name('searchDoctors2');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/signup', fn () => view('signup'))->name('signup');
Route::get('/login', [UserController::class, 'loginView'])->name('login');
Route::get('/password', function(){
    return $hashedPassword = Hash::make('123456789');
})->name('password');
// User Authentication Routes (public)
Route::post('/send-otp', [UserController::class, 'sendOtpMobile'])->name('sendOtp');
Route::post('/login', [UserController::class, 'loginMobile'])->name('login.post');
Route::post('/register/client', [UserController::class, 'registerClient'])->name('clientRegister');
Route::post('/register/doctor', [UserController::class, 'registerDoctor'])->name('doctorRegister');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/countries', [LocalityController::class, 'getCountries'])->name('countries');
Route::get('/states', [LocalityController::class, 'getStates'])->name('states');
Route::get('/cities/{state}', [LocalityController::class, 'getCities'])->name('cities');
Route::get('/allcities', [LocalityController::class, 'getAllCities'])->name('allCities');
Route::get('/location', [LocalityController::class, 'getLocationByIP'])->name('location');
Route::get('/all-languages', [LocalityController::class, 'listLanguages']);
Route::get('/available-slots', [AppointmentController::class, 'getAvailableSlots'])->name('getAvailableSlots');
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin', function () {
    return view('admin.login');
})->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');


// Route to fetch all details (conditions, experiences, languages, galleries) for a specific doctor
Route::get('/doctor/{doctor_id}/details', [DoctorController::class, 'getDoctorDetails']);
/*
|----------------------------------------------------------------------
| Protected Routes (Requires Authentication)
|----------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // User Profile Management
    

Route::post('razorpay/create-order', [RazorpayController::class, 'createOrder']);
Route::post('razorpay/verify-payment', [RazorpayController::class, 'verifyPayment']);



    /*
    |----------------------------------------------------------------------
    | Client Routes
    |----------------------------------------------------------------------
    */
    Route::middleware(['client'])->group(function () {
        Route::get('/book-appointment', [AppointmentController::class, 'show'])->name('bookAppointment');
        Route::get('/reschedule-appointment', [AppointmentController::class, 'view'])->name('editAppointment');
        Route::get('/profile', [UserController::class, 'getUserDetails'])->name('client.profile');
    
        Route::post('/profile/update', [UserController::class, 'updateUser'])->name('client.update');
        Route::get('/appointment-details', [AppointmentController::class, 'show'])->name('appointmentDetails');
        Route::get('/appointments', [AppointmentController::class, 'getAppointments'])->name('client.appointments');
        Route::post('/appointments/book', [AppointmentController::class, 'bookAppointment'])->name('client.submitBooking');
        Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancelAppointment'])->name('client.cancelAppointment');
        Route::post('/appointments/{id}/update', [AppointmentController::class, 'updateAppointment'])->name('client.updateAppointment');
        Route::post('/submit-review', [AppointmentController::class, 'storeReview']);



        // Doctor Details
        Route::get('/doctor/{id}', [UserController::class, 'doctorDetails'])->name('doctor.details');

        // Doctors List
        Route::get('/doctors', [UserController::class, 'doctorList'])->name('doctors.list');
    });

    /*
    |----------------------------------------------------------------------
    | Doctor Routes
    |----------------------------------------------------------------------
    */
    Route::middleware(['doctor'])->prefix('doctor-dashboard')->group(function () {
        Route::get('/', [AppointmentController::class, 'doctorDashboard'])->name('doctorDashboard1');
        // Route to update or save all data (conditions, experiences, languages, galleries) in one request
        Route::post('galleries', [GalleryController::class, 'store']); // for uploading images
        // routes/web.php
Route::delete('/galleries/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');

Route::post('/doctor/update-data', [UserController::class, 'updateDoctorData']);
        Route::get('/profile', [UserController::class, 'viewProfile'])->name('doctor.profile');
        Route::get('/editprofile', [UserController::class, 'getUserDetails'])->name('doctor.profile.edit');
        Route::post('/profile/update', [UserController::class, 'updateUser'])->name('doctor.update');
    
        Route::get('/fee', fn () => view('doctor-dashboard.fee'))->name('fee');
        Route::get('/conditions', [DoctorController::class, 'getDoctorConditions'])->name('conditions');
        Route::get('/galleries', [DoctorController::class, 'getDoctorGalleries'])->name('galleries');
            Route::get('/transactions', [WalletController::class, 'index'])->name('wallet.show');
            Route::post('/add-funds', [WalletController::class, 'addFunds'])->name('wallet.addFunds');
            Route::post('/withdraw', [WithdrawalController::class, 'store'])->name('withdraw');
            Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals');
        
        // Slot Management
        Route::get('/slots', [SlotController::class, 'getDoctorSlots'])->name('addSlot');
        Route::get('/slots/{id}', [SlotController::class, 'show']);
        Route::post('/slots', [SlotController::class, 'store']);
        Route::put('/slots/{id}', [SlotController::class, 'update'])->name('slot.update');
        Route::delete('/slots/{id}', [SlotController::class, 'destroy'])->name('slots.destroy');
       
        Route::get('/banks', [BankController::class, 'index'])->name('banks.index');
    Route::post('/banks', [BankController::class, 'store'])->name('banks.store');
    Route::put('/banks/{id}', [BankController::class, 'update'])->name('banks.update');
    Route::delete('/banks/{id}', [BankController::class, 'destroy'])->name('banks.destroy');
    Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancelAppointment'])->name('doctor.cancelAppointment');
        Route::get('/appointments', [AppointmentController::class, 'getAppointments'])->name('doctor.appointments');
        Route::get('/dashboard', [AppointmentController::class, 'doctorDashboard'])->name('doctorDashboard');
        Route::post('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('doctor.updateStatus');
        Route::post('/appointments/{id}/update', [AppointmentController::class, 'updateAppointment'])->name('doctor.updateAppointment');
    });

    Route::middleware(['admin'])->group(function () {
        
Route::prefix('admin')->group(function () {
    Route::get('change-password', [AdminAuthController::class, 'showChangePasswordForm'])->name('admin.change-password');
Route::post('/change-password', [AdminAuthController::class, 'updatePassword'])->name('admin.change-password.update');
    
    
    Route::get('/', [AdminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('adminLogout');
    Route::get('/doctors', [AdminController::class, 'listUsers'])->name('admin.doctorList');
    Route::post('/doctors', [AdminController::class, 'listUsers'])->name('admin.doctorList');
    Route::get('/doctor/details/{id}', [AdminController::class, 'findUser'])->name('doctorView');
    Route::get('/client/details/{id}', [AdminController::class, 'findUser'])->name('clientView');
    Route::get('/doctor/edit/{id}', [AdminController::class, 'findUser'])->name('doctorEdit');
    Route::get('/client/edit/{id}', [AdminController::class, 'findUser'])->name('clientEdit');
    Route::post('/user/update', [AdminController::class, 'updateUser'])->name('userUpdate');
    Route::post('/user/store', [AdminController::class, 'store'])->name('user.store');
    Route::get('/clients', [AdminController::class, 'listUsers'])->name('admin.clientList');
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('updateUserAdmin');
    Route::get('/appointments', [AdminController::class, 'listAppointments'])->name('admin.appointmentList');
    Route::get('/wallet-history', [AdminController::class, 'walletEntries'])->name('admin.wallets');
    Route::get('/income-history', [AdminController::class, 'incomeEntries'])->name('admin.incomes');
    Route::get('/withdrawal-history', [AdminController::class, 'listWithdrawals'])->name('admin.withdrawals');
    Route::put('/withdrawals/update', [AdminController::class, 'updateWithdrawal'])->name('withdrawals.update');
    Route::get('/notifications', [AdminController::class, 'listNotifications'])->name('admin.notifications');
    Route::post('admin/notifications/store', [AdminController::class, 'storeNotification'])->name('notifications.store');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::put('/admin/settings/update', [AdminController::class, 'updateSettings'])->name('admin.update.settings');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::put('/reviews/{id}', [AdminController::class, 'update'])->name('reviews.update');
    Route::get('/contact-forms', [LocalityController::class, 'contactForms'])->name('admin.contactForms');
    // Page Routes
    Route::get('/pages', [PageController::class, 'index'])->name('admin.pages'); // List all pages
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create'); // Show form to create a new page
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store'); // Store a new page
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit'); // Edit a page
    Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update'); // Update a page
    Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy'); // Delete a page
    

});

});
});