<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OTP\OtpController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);

// OTP
Route::post('/verifyotp', [OtpController::class, 'verification']);
Route::post('/expiredotp', [OtpController::class, 'expiredverification']);
Route::post('/resendotp', [OtpController::class, 'resend']);