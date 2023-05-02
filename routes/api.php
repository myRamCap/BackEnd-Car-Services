<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OTP\OtpController;
use App\Http\Controllers\Api\ServiceCenterController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServicesLogoController;
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
    Route::resource('/serviceslogo', ServicesLogoController::class);
    Route::resource('/services', ServiceController::class);
    Route::resource('/servicecenter', ServiceCenterController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/changepwd/{id}', [AuthController::class, 'changePass']);
Route::post('/login', [AuthController::class, 'login']);
// Email Verification
Route::post('/verifyotp', [OtpController::class, 'verification']);
Route::post('/expiredotp', [OtpController::class, 'expiredverification']);
Route::post('/resendotp', [OtpController::class, 'resend']);
