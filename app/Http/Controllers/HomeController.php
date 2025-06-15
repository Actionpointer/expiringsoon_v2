<?php

namespace App\Http\Controllers;

use App\Models\Adset;
use App\Models\Order;
use App\Models\Advert;
use Tzsk\Otp\Facades\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\GeoLocationTrait;
use App\Notifications\OTPNotification;

class HomeController extends Controller
{
    use GeoLocationTrait;
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        /** @var \App\Models\User $user **/
        $user = auth()->user(); 
        abort_if(!$user->is_admin,403,'Unauthorized');
        return view('backend.dashboard');
    }

    public function otp_send(){
        // Check if OTP was recently sent (within last 2 minutes)
        if (!session()->has('otp_sent') || now()->diffInMinutes(session('otp_sent')) > 2) {
            $this->initiateOTP();
            // Reset the OTP sent timestamp
            session(['otp_sent' => now()]);
        }
        return response()->json(['message'=> 'OTP Sent','status'=> 1],200);
    }

    public function initiateOTP(){
        $user = auth()->user();
        $otp = Otp::generate($user->email);
        $user->notify(new OTPNotification($otp));
    }

    public function otp_verify(Request $request){
        $valid = Otp::match($request->otp, auth()->user()->email);
        if($valid){
            $user = auth()->user();
            $user->email_verified_at = now();
            $user->verify_skip_hours = $request->verify_skip_hours ? 30*24 : 12;
            $user->save();  
            // Clear the OTP sent timestamp
            session()->forget('otp_sent');
            
            return response()->json(['status'=> true,'message'=> 'Email Verified'],200);
        }else{
            return response()->json(['status'=> false,'message'=> 'Invalid OTP'],201);
        }
    }

    public function adpreview(Adset $adset,Advert $advert){
        $adplan_id = $adset->adplan->id;
        return view('vendor.adverts.preview',compact('advert','adplan_id'));
    }   
    
}
