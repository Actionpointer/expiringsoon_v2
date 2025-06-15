<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

trait SecurityTrait
{
    protected function checkPin(Request $request){
        $access = false;
        $executed = RateLimiter::attempt(
            'access-pin:'.auth()->user()->id,
            $perMinute = cache('settings')['throttle_security_attempt'],
            function() {
                if(!auth()->user()->pin){
                    return ['result'=> 0,'message'=> 'Pin is not set. Set pin at profile'];
                }
                $access = Hash::check(request()->pin, auth()->user()->pin->body);
                if(!$access){
                    return ['result'=> 0,'message'=> 'Wrong Pin'];
                }
                return  ['result'=> 1];
            },$decaySeconds = cache('settings')['throttle_security_time']*60
        );
        if(!$executed) {
            $seconds = RateLimiter::availableIn('access-pin:'.auth()->id());
            return ['result'=> 0,'message'=> 'Too many tries. Try again in about '.ceil($seconds/60).' minutes.'];
        }else{
            return $executed;
        }
        
        
    }

    protected function pinRecentlyChanged(){
        $user = auth()->user();
        return $user->pin && $user->pin->last_updated_at->diffInHours(now()) > 24;
    }
}