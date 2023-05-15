<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OTP\OtpController;
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

    Route::get('/service_center/timeslot/{id}/{year}/{month}/{day}',[ServiceCenterTimeSlotController::class, 'timeslot']);
    Route::get('/service_center/vehicle/{id}', [VehicleController::class, 'vehicle']);
    // Route::get('/servicecenter/services', [ServiceCenterServicesController::class, 'test']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/changepwd/{id}', [AuthController::class, 'changePass']);
Route::post('/login', [AuthController::class, 'login']);

// Client
Route::post('/client_register', [ClientController::class, 'register']);
Route::post('/client_login', [ClientController::class, 'login']);
Route::post('/client_verify', [ClientController::class, 'verification']);

// Email Verification
Route::post('/verifyotp', [OtpController::class, 'verification']);
Route::post('/expiredotp', [OtpController::class, 'expiredverification']);
Route::post('/resendotp', [OtpController::class, 'resend']);



