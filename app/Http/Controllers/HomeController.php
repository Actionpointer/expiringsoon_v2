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
        /** @var \App\Models\User $user **/
        $user = auth()->user(); 
        if($user->isRole('shopper')){
            return view('customer.dashboard',compact('user'));
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
    
}
