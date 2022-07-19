<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\Shop;
use App\Models\City;
use App\Models\State;
use App\Models\Category;
use App\Models\Setting;
use App\Models\BankInfo;
use App\Models\Discount;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    public function index(){
        $shops = Shop::all();
        return view('frontend.shop.list',compact('shops'));
    }

    public function show(Shop $shop){
        $categories = Category::all();
        // dd($categories);
        return view('frontend.shop.view',compact('shop','categories'));
    }

/* Vendor area */

    public function list(){
        $user = auth()->user();
        // dd($user);
        return view('shop.list',compact('user'));
    }

    public function create(){
        $states = State::all();
        $cities = City::all();
        return view('shop.create',compact('states','cities'));
    }
    public function store(Request $request){
        if($request->hasFile('photo')){
            $name = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$name);
        }
        $shop = Shop::create(['name'=> $request->name,'slug'=> explode(' ',$request->name)[0],'email'=>$request->email,'phone'=>$request->phone,'banner'=>$name,'address'=> $request->address,'state_id'=> $request->state,'city_id'=> $request->city_id]);
        return redirect()->route('shop.settings',$shop);
    }
    
    public function dashboard(Shop $shop){
        // dd($shop->user);
        return view('shop.dashboard',compact('shop'));
    }

    public function settings(Shop $shop){
        $user = auth()->user();
        $banks = Bank::all();
        $states = State::all();
        $minThreshold = Setting::where('name','minThreshold')->first()->value;
        return view('shop.settings',compact('user','shop','banks','states','minThreshold'));
    }

    public function address(Request $request){
        $user = auth()->user();
        if($request->address) $user->address = $request->address;
        if($request->state) $user->state = $request->state;
        $user->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Address Updated Successfully']);
    }

    public function bank_info(Request $request){
        $user = auth()->user();
        BankInfo::updateOrCreate(['user_id'=> $user->id],['acctname'=> $request->acctname,'acctno'=> $request->acctno,'bank'=> $request->bank]);
        return redirect()->back()->with(['result'=> '1','message'=> 'Bank details Updated']);
    }

    public function upload_id(Request $request){
        $user = auth()->user();
        $ext = $request->file('theDoc')->getClientOriginalExtension();
        $filename = $user->id.rand().time().'.'.$ext;
        $request->file('theDoc')->storeAs('public/uploads',$filename);//save the file to public folder
        $kyc = Kyc::updateOrCreate(['user_id'=> $user->id,'type'=> $request->idType],['doctype'=> $ext,'document'=> 'uploads/'.$filename]);
        return redirect()->back()->with(['result'=> '1','message'=> 'Verification Document Saved']);
    }

    
    public function discounts(Request $request){
        $user = auth()->user();
        Discount::updateOrCreate(['user_id'=> $user->id],['expiry'=> $request->expirydate,'discount'=> $request->discount]);
        return redirect()->back()->with(['result'=> '1','message'=> 'Discount Saved']);
    }


/* Admin area */
    public function adminIndex(){

    }
    public function adminShow(){

    }
    
    public function products(Shop $shop)
    {
        return view('shop.product.list',compact('shop'));
    }

    public function orders(Shop $shop){

    }
}
