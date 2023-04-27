<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OTP\OtpController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOGE4MTAwMmM1NjczZTg5YTUzN2FhZjUwNmYzNTU3NjBhZjQ3MGI5ZmYwOTA2MmI4NTE1OTliNjY4MjA1NzI3YjM2NzRmN2Q4YjM3N2MwYWUiLCJpYXQiOjE2ODAxNTQ2MzMuMTk3OTQyLCJuYmYiOjE2ODAxNTQ2MzMuMTk3OTQ3LCJleHAiOjE3MTE3NzcwMzMuMTcyODAxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Xo54fUwyltWQBGdxrMQpEzGCzUTkCRPVHIA_0B1IARHYc_x5FkuFHTaSj99QvnWVu2iNTWzkforJlejiEFLCSS6rHfDIA-WKCPLWy5gJuZ8Ee_bj2okJXiZMKaTX9W7yQRUCGrOrI1nK-SnVSqKiDJfLvH50LaORyljzdu2LI1KbNWS8NZt5uveo9zRWJ5iJRpk1KBMkrLS4CVg150Qrzc378zsXGc95_qBff5NohrTegp27G6r9wc9vAiI_3hn7cFPw0tcR804-v9MQkSY69khA7gKah-shTnw8GrofGLsa10mPdPwTdY7fFSdF5epxOFDYDhJV_2-tullnIwyFxPcTkFNMCdSi6V4A4mnRbaqzrCuslL3L6AelZUaaG4QzBXoiw5jg0Rs40x6ApGuw7-iM9vBzr-SMl1X5lW2aCdgxD6lADaYIAlkHiOiyDC75GEOPu1MylBAHx4kbw6AFpde8aHlrgT1X0zuy5EJvSc8VBaNGQiPt0i8gIhrqUH0Q5OgBXDqSwU35c33SCOzG65rBz6WNVmbTjztnEaaTf2-cOTmNPKXK3BWHIz6TpIoCK8JmdD3yi3yQAigxEpdGxyzoMU2NELGDd7JnlY9Fz7vrLBN0EmM9T7CFB7sET1JFALMpTIuvCHicbjMWPpHhqOvDgcO0EGCoZlzrX7eYu8o

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/serviceslogo', ServicesLogoController::class);
    Route::resource('/services', ServiceController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});






Route::post('/changepwd/{id}', [AuthController::class, 'changePass']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/data', [AuthController::class, 'getall']);

// Email Verification
Route::post('/verifyotp', [OtpController::class, 'verification']);
Route::post('/expiredotp', [OtpController::class, 'expiredverification']);
Route::post('/resendotp', [OtpController::class, 'resend']);