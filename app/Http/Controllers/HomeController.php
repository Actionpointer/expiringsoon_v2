<?php

namespace App\Http\Controllers;

use App\Models\Adset;
use App\Models\Order;
use App\Models\Advert;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\GeoLocationTrait;

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

    public function adpreview(Adset $adset,Advert $advert){
        return view('vendor.adverts.preview',compact('advert'));
    }   
    
}
