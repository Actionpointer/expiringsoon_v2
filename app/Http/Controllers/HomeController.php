<?php

namespace App\Http\Controllers;

use App\Http\Traits\GeoLocationTrait;

class HomeController extends Controller
{
    use GeoLocationTrait;
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function home(){
        $user = auth()->user(); 
        if($user->role == 'shopper'){
            return view('customer.dashboard',compact('user'));
        }
        if($user->role == 'vendor' && !$user->subscription_id){
            $shop = $user->shop;
            return redirect()->route('vendor.shop.show',$shop);
        }
        if($user->role == 'vendor' && $user->subscription_id){
            return redirect()->route('vendor.dashboard');
        }
       
        return redirect()->route('admin.dashboard');
    }
    
}
