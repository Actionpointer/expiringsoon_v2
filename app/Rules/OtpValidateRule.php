<?php

namespace App\Rules;

use App\Models\OneTimePassword;
use Illuminate\Contracts\Validation\Rule;

class OtpValidateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = auth()->user();
        $otp = OneTimePassword::where('user_id',$user->id)->where('code', $value)->first();
        if(!$otp){
            return false;
        }
        if($otp->created_at->addMinutes(cache('settings')['throttle_otp_time']) < now()){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is invalid';
    }
}
