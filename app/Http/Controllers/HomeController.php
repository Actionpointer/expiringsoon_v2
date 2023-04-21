<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Ixudra\Curl\Facades\Curl;
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
        $orders = Order::where('user_id',$user->id)->whereHas('statuses')->get();
        return view('customer.dashboard',compact('user','orders'));
    }
    
}
