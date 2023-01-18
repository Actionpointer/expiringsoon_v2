<?php

namespace App\Http\Controllers;


use App\Models\Kyc;
use App\Models\City;
use App\Models\Shop;
use App\Models\Order;
use App\Models\State;
use App\Models\Advert;
use App\Models\Payout;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\GeoLocationTrait;
// use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    use GeoLocationTrait;
    
    public function __construct(){
        $this->middleware('auth')->except(['index','hotdeals']);
    }
    
    public function cities(Request $request){
        $cities = City::where('state_id',$request->state_id)->get();
        return response()->json($cities,200);
    }
    
    public function home(){
        $user = auth()->user(); 
        // return $user->subscription->name;
        request()->session()->reflash();
        if($user->role == 'shopper'){
            return view('customer.dashboard',compact('user'));
        }
        if($user->role == 'vendor' && !$user->subscription_id){
            $shop = $user->shop;
            return redirect()->route('shop.show',$shop);
        }
        if($user->role == 'vendor' && $user->subscription_id){
            return redirect()->route('vendor.dashboard');
        }
       
        return redirect()->route('admin.dashboard');
    }
    

    public function admin(){
        $user = auth()->user();
        $documents = Kyc::where('status',false)->whereNull('reason')->take(5)->get(); 
        // dd($documents[0]->verifiable);
        $orders = Order::where('status','processing')->latest()->take(5)->get();   
        $payouts = Payout::where('status','pending')->orderBy('created_at','asc')->take(5)->get();   
        return view('admin.dashboard',compact('user','documents','orders','payouts'));
    }

    public function analytics(){
        return view('vendor.analytics');
    }
    
}
