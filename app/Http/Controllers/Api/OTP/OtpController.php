<?php

namespace App\Http\Controllers\Api\OTP;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\Verifytoken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function verification(Request $request) {
        $get_token = $request->token;
        $get_email = $request->email;
        $get_token = Verifytoken::where('token',$get_token)->where('email',$get_email)->orderBy('created_at', 'desc')->first();
        
        if ($get_token) {
            $get_token->is_activated = 1;
            $get_token->save();
            // $user = User::where('email', $get_token->email)->orderBy('created_at', 'desc')->first();
            // $user->is_activated = 1;
            // $user->save();
            // $getting_token = Verifytoken::where('token', $get_token->token)->orderBy('created_at', 'desc')->first();
            // $getting_token->delete();
            // return response("" ,204);
            $user = User::where('email', $get_token->email);
            return response($user);
        } else {
            return response([
                'message' => 'Invalid verification code'
            ], 422);
        }
    }

    public function expiredverification(Request $request) {
        $get_email = $request->email;

        Verifytoken::where('email',$get_email)->where('is_expired', 0)->update(['is_expired' => 1]);
        // $get_email->save();
        return response('OTP Expired');
    }

    public function resend(Request $request) {
        $email = $request->email;

        $validToken = rand(100000, 999999);
        $get_token = new Verifytoken();
        $get_token->token = $validToken;
        $get_token->email = $email;
        $get_token->save();
        $get_user_email = $email;
        $get_user_name = $email;
        Mail::to($email)->send(new WelcomeMail($get_user_email, $validToken, $get_user_name));

        return response('Email Resend successfully');
    }
}
