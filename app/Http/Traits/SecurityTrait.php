<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\OTPNotification;
use Illuminate\Support\Facades\RateLimiter;

trait SecurityTrait
{
    protected function checkPin(Request $request){
        $access = Hash::check(request()->pin, auth()->user()->pin);
        $executed = RateLimiter::attempt(
            'access-pin:'.auth()->id(),
            $perMinute = cache('settings')['throttle_pin_attempt'],
            function() use($access) {
                return $access;
            },$decaySeconds = cache('settings')['throttle_pin_time']*60
        );
        if(!$executed) {
            $seconds = RateLimiter::availableIn('access-pin:'.auth()->id());
            return ['result'=> 0,'message'=> 'Too many tries. Try again in about '.ceil($seconds/60).' minutes.'];
        }
        if(!$access){
            return ['result'=> 0,'message'=> 'Wrong Pin'];
        }
        return ['result'=> 1];
    }

    protected function checkOTP($code){
        $user = auth()->user();
        $executed = RateLimiter::attempt(
            $code.$user->id,
            $perMinute = cache('settings')['throttle_otp_attempt'],
            function() use($user,$code){
                // $user->notify(new OTPNotification($code));
            },$decaySeconds = cache('settings')['throttle_otp_time']*60
        );
        if(!$executed) {
            $seconds = RateLimiter::availableIn($code.$user->id);
            return ['result'=> 0,'message'=> 'Too many tries. Try again in about '.ceil($seconds/60).' minutes.'];
        }
        return ['result'=> 1,'message'=> 'OTP has been sent to your email'];
    }
}