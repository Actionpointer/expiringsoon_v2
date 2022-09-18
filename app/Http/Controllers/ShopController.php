<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\City;
use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Account;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Discount;
use App\Models\ShippingRate;
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
        $category = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->get();
        
        $shops = Shop::active()->approved()->visible()->selling();
        if(request()->query() && request()->query('state_id')){
            $state_id = request()->query('state_id');
            $shops = $shops->where('state_id',$state_id);
        }else{$state_id = 0;}
        if(request()->query() && request()->query('category_id')){
            $category_id = request()->query('category_id');
            $category = Category::find($category_id);
            $shops = $shops->whereHas('products',function($query) use($category_id){
                $query->where('category_id',$category_id);
            });
        }
        if(request()->query() && request()->query('sortBy')){
            if(request()->query('sortBy') == 'name_asc'){
                $shops = $shops->orderBy('name','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $shops = $shops->orderBy('name','desc');
            }
        }
        $shops = $shops->paginate(16);
        $advert_G = Advert::state($state_id)->running()->certifiedShop()->where('position',"G")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_H = Advert::state($state_id)->running()->certifiedShop()->where('position',"H")->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
        return view('frontend.shop.list',compact('shops','category','categories','states','state_id','advert_G','advert_H'));
    }

    public function show(Shop $shop){
        if(!$shop->isCertified())
        abort(404,'Shop is not available');
        $category = null;
        $categories = Category::has('products')->get();
        $products = Product::where('shop_id',$shop->id)->edible()->approved()->active()->accessible()->available()->visible();
        if(request()->query() && request()->query('category_id')){
            $products = $products->where('category_id',request()->query('category_id'));
            $category = Category::find(request()->query('category_id'));
        }
        if(request()->query() && request()->query('sortBy')){
            if(request()->query('sortBy') == 'price_asc'){
                $products = $products->orderBy('price','asc');
            }
            if(request()->query('sortBy') == 'price_desc'){
                $products = $products->orderBy('price','desc');
            }
        }
        $products = $products->paginate(16);
        return view('frontend.shop.view',compact('shop','categories','products','category'));
    }

/* Vendor area */

    public function list(){
        $user = auth()->user();
        // dd($user);
        return view('vendor.shop.list',compact('user'));
    }

    public function create(){
        $states = State::all();
        $cities = City::all();
        return view('vendor.shop.create',compact('states','cities'));
    }
    public function store(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|max:1024',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('photo')){
            $name = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$name);
        }
        $shop = Shop::create(['name'=> $request->name,'slug'=> explode(' ',$request->name)[0],'email'=>$request->email,'phone_prefix'=> cache('settings')['dialing_code'],'phone'=>$request->phone,'banner'=>$name,'address'=> $request->address,'state_id'=> $request->state,'city_id'=> $request->city_id]);
        $user->role = 'vendor';
        $user->save();
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
        $minThreshold = Setting::where('name','basic_minimum_payout')->first()->value;
        $rates = ShippingRate::where('shop_id',$shop->id)->get();
        return view('shop.settings',compact('user','shop','banks','states','minThreshold','rates'));
    }

    // public function address(Request $request){
    //     $user = auth()->user();
    //     if($request->address) $user->address = $request->address;
    //     if($request->state) $user->state = $request->state;
    //     $user->save();
    //     return redirect()->back()->with(['result'=> '1','message'=> 'Address Updated Successfully']);
    // }

    public function bank_info(Request $request){
        $user = auth()->user();
        Account::updateOrCreate(['user_id'=> $user->id],['acctname'=> $request->acctname,'acctno'=> $request->acctno,'bank'=> $request->bank]);
        return redirect()->back()->with(['result'=> '1','message'=> 'Bank details Updated']);
    }

    public function upload_id(Request $request,Shop $shop){
        $user = auth()->user();
        $ext = $request->file('theDoc')->getClientOriginalExtension();
        $filename = $user->id.rand().time().'.'.$ext;
        $request->file('theDoc')->storeAs('public/uploads',$filename);//save the file to public folder
        $kyc = Kyc::updateOrCreate(['shop_id'=> $shop->id,'type'=> $request->idType],['user_id'=> $request->owner ? $user->id: '','doctype'=> $ext,'document'=> 'uploads/'.$filename]);
        return redirect()->back()->with(['result'=> '1','message'=> 'Verification Document Saved']);
    }

    public function notifications(Shop $shop){
        
    }
    public function discounts(Request $request){
        $user = auth()->user();
        return redirect()->back()->with(['result'=> '1','message'=> 'Discount Saved']);
    }


/* Admin area */
    public function admin_index(){
        $shops = Shop::all();
        return view('admin.shops.list',compact('shops'));
    }
    public function admin_view(Shop $shop){
        return view('admin.shops.view',compact('shop'));
    }

    public function admin_manage(Request $request){
        $shop = Shop::find($request->shop_id);
        $shop->approved = $request->approved;
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Shop Status Updated']);
    }
    
    public function admin_kyc(Request $request){
        $kyc = Kyc::find($request->kyc_id);
        $kyc->status = $request->status;
        $kyc->reason = $request->reason ?? null;
        $kyc->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'KYC Document updated']);

    }
    

    
}
