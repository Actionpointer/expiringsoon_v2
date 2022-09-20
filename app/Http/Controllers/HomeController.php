<?php

namespace App\Http\Controllers;


use App\Models\Kyc;
use App\Models\City;
use App\Models\Shop;
use App\Models\Order;
use App\Models\State;
use App\Models\Advert;
use App\Models\Category;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth')->except(['index','hotdeals']);
    }

    public function index(){
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $state = auth()->check() && auth()->user()->state_id ? auth()->user()->state->name : session('geo_locale')['state'];
        $state_id = State::where('name',$state)->first()->id;
        $advert_A = Advert::state($state_id)->running()->certifiedShop()->where('position',"A")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_B = Advert::state($state_id)->running()->certifiedShop()->where('position',"B")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_Z = Advert::with('product')->state($state_id)->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        return view('frontend.index',compact('categories','advert_A','advert_B','advert_Z'));
    }

    public function hotdeals(){
        $state = auth()->check() && auth()->user()->state_id ? auth()->user()->state->name : session('geo_locale')['state'];
        $state_id = State::where('name',$state)->first()->id;
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
        if($user->role == 'shopper'){
            return view('customer.dashboard',compact('user'));
        }
        if($user->role == 'vendor'){
            if($staff = $user->staff->where('role','staff')->first()){
                $shop = $staff->shop;
                return redirect()->route('shop.dashboard',$shop);
            }else{
                return redirect()->route('vendor.dashboard');
            }
        }
        return redirect()->route('admin.dashboard');
    }

    public function vendor(){
        $user = auth()->user(); 
        return view('vendor.dashboard',compact('user'));
    }
    
    public function shop(Shop $shop){
        $user = auth()->user(); 
        return view('shop.dashboard',compact('user'));
    }

    public function admin(){
        $user = auth()->user();
        $documents = Kyc::where('status',false)->whereNull('reason')->take(20)->get(); 
        // dd($documents[0]->verifiable);
        $orders = Order::where('status','new')->orderBy('created_at','desc')->get();   
        return view('admin.dashboard',compact('user','documents','orders'));
    }

    public function analytics(){
        return view('vendor.analytics');
    }
    
}
