<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tzsk\Otp\Facades\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\OTPNotification;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $otp = Otp::generate($user->email);
        $user->notify(new OTPNotification($otp));
        return response()->json(['message' => 'OTP sent to email'], 200);
        
        
    }

}
