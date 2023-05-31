<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OTP\OtpController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\ServiceCenterBookingController;
use App\Http\Controllers\Api\ServiceCenterController;
use App\Http\Controllers\Api\ServiceCenterServicesController;
use App\Http\Controllers\Api\ServiceCenterTimeSlotController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServicesLogoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/users', UserController::class);
    Route::resource('/serviceslogo', ServicesLogoController::class);
    Route::resource('/services', ServiceController::class);
    Route::resource('/servicecenter', ServiceCenterController::class);
    Route::resource('/vehicles', VehicleController::class);
    Route::resource('/service_center/services', ServiceCenterServicesController::class);
    Route::resource('/service_center/timeslot', ServiceCenterTimeSlotController::class);
    Route::resource('/service_center/booking', ServiceCenterBookingController::class);
    Route::resource('/client', ClientController::class);
    Route::resource('/notification', NotificationController::class);
    Route::resource('/booking', BookingController::class);
    Route::resource('/promotion', PromotionController::class);


    
    Route::get('/branchmanager/{id}', [UserController::class, 'branchmanager']);
    Route::get('/corporateservicecenter/{id}', [ServiceCenterController::class, 'corporate']);
    Route::get('/corporate_account', [UserController::class, 'corporate']);
    Route::get('/upcomingbooking/{id}', [ServiceCenterBookingController::class, 'upcoming']);
    Route::get('/records/{id}', [ServiceCenterBookingController::class, 'records']);
    Route::get('/servicecenters', [ServiceCenterController::class, 'getall']);
    Route::get('/servicecenters/{category}', [ServiceCenterController::class, 'getCategory']);
    Route::get('/roles/{id}', [RolesController::class, 'show']);
    Route::get('/service_center/timeslot/{id}/{year}/{month}/{day}',[ServiceCenterTimeSlotController::class, 'timeslot']);
    Route::get('/bookings/service_center/services/{id}', [BookingController::class, 'services']);
    Route::get('/bookings/{id}/{year}/{month}/{day}',[BookingController::class, 'timeslot']);
    Route::get('/bookings/service_center/{id}',[BookingController::class, 'service_center']);
    Route::get('/service_center/vehicle/{id}', [VehicleController::class, 'vehicle']);
    Route::get('/client_name', [ClientController::class, 'clients']);
    // Route::get('/servicecenter/services', [ServiceCenterServicesController::class, 'test']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/changepwd/{id}', [AuthController::class, 'changePass']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot_password', [AuthController::class, 'forgot_password']);

// Client
Route::post('/client_register', [ClientController::class, 'register']);
Route::post('/client_login', [ClientController::class, 'login']);
Route::post('/client_verify', [ClientController::class, 'verification']);

// Email Verification
Route::post('/verifyotp_forgotpwd', [OtpController::class, 'verify']);
Route::post('/verifyotp', [OtpController::class, 'verification']);
Route::post('/expiredotp', [OtpController::class, 'expiredverification']);
Route::post('/resendotp', [OtpController::class, 'resend']);



