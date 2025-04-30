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
    
    public function home(){
        /** @var \App\Models\User $user **/
        $user = auth()->user(); 
        if($user->isRole('shopper')){
            return redirect()->route('dashboard');
        }
        if($user->isRole('staff')){
            $shop = $user->shop;
            return redirect()->route('vendor.shop.show',$shop);
        }
        if($user->isRole('vendor')){
            return redirect()->route('vendor.dashboard');
        }
       
        return redirect()->route('admin.dashboard');
    }

    public function dashboard(){
        /** @var \App\Models\User $user **/         
        $user = auth()->user(); 
        DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$user->id)->where('notifiable_type','App\Models\User')->whereJsonContains('data->related_to','user')->update(['read_at'=> now()]);
        $orders = Order::where('user_id',$user->id)->whereHas('statuses')->get();
        return view('customer.dashboard',compact('user','orders'));
    }

    public function otp_resend(){
        // Check if OTP was recently sent (within last 2 minutes)
        if (!session()->has('otp_sent') || now()->diffInMinutes(session('otp_sent')) > 2) {
            $this->otp_send();
            // Reset the OTP sent timestamp
            session(['otp_sent' => now()]);
        }
        return response()->json(['message'=> 'OTP Sent','status'=> 1],200);
    }

    public function otp_send(){
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
