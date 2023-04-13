<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Mail\WelcomeMail;
use App\Models\Verifytoken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)){
            return response([
                'message' => 'Provided email address or password is incorrect'
            ], 422);
        }

         /** @var User $user */
        $user = Auth::user();

        $removeToken = Verifytoken::where('email', $user->email)->where('is_activated', 0);
        $removeToken->delete();
        // Verifytoken::where('token',$get_token)->where('email',$get_email)->orderBy('created_at', 'desc')->first();

// return $user->email;
        $validToken = rand(100000, 999999);
        $get_token = new Verifytoken();
        $get_token->token = $validToken;
        $get_token->email = $user->email;
        $get_token->save();
        $get_user_email = $user->email;
        $get_user_name = $user->name;
        Mail::to($user->email)->send(new WelcomeMail($get_user_email, $validToken, $get_user_name));

       //jhonrayangcon1423@gmail.com

        return response($user);
    }
}
