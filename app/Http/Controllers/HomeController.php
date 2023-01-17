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

    public function index(){
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $state = $this->currentState();
        $state_id = $state->id;
        $advert_A = Advert::state($state_id)->running()->certifiedShop()->where('position',"A")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_B = Advert::state($state_id)->running()->certifiedShop()->where('position',"B")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_Z = Advert::with('product')->state($state_id)->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        return view('frontend.index',compact('categories','advert_A','advert_B','advert_Z'));
    }

    public function hotdeals(){
        $state = $this->currentState();
        $state_id = $state->id;
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $advert_C = Advert::state($state_id)->running()->certifiedShop()->where('position',"C")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_D = Advert::state($state_id)->running()->certifiedShop()->where('position',"D")->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_E = Advert::state($state_id)->running()->certifiedShop()->where('position',"E")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_Z = Advert::with('product')->state($state_id)->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        // dd($advert_Z);
        
        return view('frontend.hotdeals',compact('categories','advert_C','advert_D','advert_E','advert_Z'));
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
            return redirect()->route('shop.dashboard',$shop);
        }
        if($user->role == 'vendor' && $user->subscription_id){
            return redirect()->route('vendor.dashboard');
        }
       
        return redirect()->route('admin.dashboard');
    }

    public function vendor(){
        $user = auth()->user(); 
        return view('vendor.dashboard',compact('user'));
    }
    
    public function verification(){
        $user = auth()->user(); 
        return view('vendor.verification',compact('user'));
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
