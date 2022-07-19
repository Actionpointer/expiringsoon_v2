<?php

namespace App\Http\Controllers;


use App\Models\Kyc;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Category;
use App\Models\Featured;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth')->except('index');
    }

    public function index(){
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $featured = Featured::all();
        // dd($featured->first()->product->shop->discounts);
        foreach($featured as $val){
            if(strtotime("today") > strtotime($val->expires)){
                $val->status = 'Expired';
                $val->save();
            }
        }
       
        return view('frontend.index',compact('categories','featured'));
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
        // dd('ok');
        $user = auth()->user(); 
        return view('vendor.dashboard',compact('user'));
    }
    
    public function shop(Shop $shop){
        $user = auth()->user(); 
        return view('shop.dashboard',compact('user'));
    }

    public function admin(){
        $user = auth()->user();
        $documents = Kyc::where('status','Pending')->take(20)->get(); 
        
        $orders = Order::orderBy('created_at','desc')->get(); 
        return view('admin.dashboard',compact('user','documents','orders'));
    }
    
}
