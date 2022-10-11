<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\City;
use App\Models\Shop;
use App\Models\User;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Models\ShippingRate;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
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
            'photo' => 'required|max:1024',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('photo')){
            $banner = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$banner);
        }
        $shop = Shop::create(['name'=> $request->name,'email'=>$request->email,'phone_prefix'=> cache('settings')['dialing_code'],'phone'=>$request->phone,'banner'=>$banner,
        'address'=> $request->address,'state_id'=> $request->state,'city_id'=> $request->city_id,'published'=> $request->published]);
        
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
        $cities = City::where('state_id',$shop->state_id)->get();
        $rates = ShippingRate::where('shop_id',$shop->id)->get();
        return view('shop.settings',compact('user','shop','banks','states','cities','rates'));
    }

    public function profile(Shop $shop,Request $request){
        $shop->name = $request->name;
        $shop->email = $request->email;
        $shop->phone = $request->phone;
        $shop->published = $request->published;
        if($request->hasFile('banner')){
            if($shop->banner) Storage::delete('public/'.$shop->banner);
            $banner = 'uploads/'.time().'.'.$request->file('banner')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$banner);
            $shop->banner = $banner;
        } 
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Shop Details Updated Successfully']);
    }

    public function address(Shop $shop,Request $request){
        $shop->address = $request->address;
        $shop->state_id = $request->state_id;
        $shop->city_id = $request->city_id;
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Address Updated Successfully']);
    }

    public function discounts(Shop $shop,Request $request){
        $shop->discount30 = $request->discount30;
        $shop->discount60 = $request->discount60;
        $shop->discount90 = $request->discount90;
        $shop->discount120 = $request->discount120;
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Discount Saved']);
    }

    public function kyc(Shop $shop,Request $request){
        // dd($request->all());
        if(!$request->idcard && !$request->addressproof && !$request->companydoc)
        return redirect()->back()->with(['result'=> 0,'message'=> 'Nothing was uploaded']);
        foreach(['idcard','addressproof','companydoc'] as $type){
            if($request[$type] && $request->hasFile($type)){
                if($shop[$type]) Storage::delete('public/'.$shop[$type]->document);
                $doctype = explode('/',$request->file($type)->getClientMimeType())[0];
                $document = 'uploads/'.time().'.'.$request->file($type)->getClientOriginalExtension();
                $request->file($type)->storeAs('public/',$document);
                $kyc = Kyc::updateOrCreate(['verifiable_id'=> $type == 'idcard'? $shop->owner()->id: $shop->id,'verifiable_type'=> $type == 'idcard'? 'App\Models\User': 'App\Models\Shop','type'=> $type],['doctype'=> $doctype,'document'=> $document,'reason'=> '']);
            } 
        }
        return redirect()->back()->with(['result'=> '1','message'=> 'Verification Document Saved']);
    }

    public function staff(Shop $shop,Request $request){
        if($request->user_id){
            if($request->delete){
                //detach user from shop
                $shop->users()->detach($request->user_id);
                $user = User::destroy($request->user_id);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted Staff']);
            }else{
                //update
                $user = User::find($request->user_id);
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'email' => ['required',Rule::unique('users')->ignore($user)],
                    'phone' => ['required',Rule::unique('users')->ignore($user)],
                    'status' => 'required|numeric'
                ]);
                if($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
                }
                $user = User::where('id',$request->user_id)->update(['fname'=> explode(' ',$request->name)[0],'lname'=> explode(' ',$request->name)[1],'status'=> $request->status,'email'=> $request->email,'phone_prefix'=> cache('settings')['dialing_code'] ,'phone'=> $request->phone]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated User']);
            }
        }else{
            //create
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string',
                'lname' => 'required|string',
                'email' => 'required|string|unique:users',
                'phone' => 'required|string|unique:users',
                'password' => 'required','string','confirmed'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not create user']);
            }
            $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'role'=> 'vendor','email'=> $request->email,'phone_prefix'=> cache('settings')['dialing_code'] ,'phone'=> $request->phone,'password'=> Hash::make($request->password),'state_id'=> $shop->state_id]);
            $shop->users()->attach($user->id,['role' =>'staff']);
            return redirect()->back()->with(['result'=> 1,'message'=> 'User created successfully']);
        }   
    }

    public function shipping(Shop $shop,Request $request){
        if($request->rate_id){
            if($request->delete){
                $user = ShippingRate::destroy($request->rate_id);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted Shipping Rate']);
            }else{
                //update
                $validator = Validator::make($request->all(), [
                    'state_id' => 'required|numeric',
                    'hours' => 'required|numeric',
                    'amount' => 'required|numeric',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not update shipping rate']);
                }
                $rate = ShippingRate::where('id',$request->rate_id)->update(['destination_id'=> $request->state_id,'hours'=> $request->hours,'amount'=> $request->amount]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated Shipping Rate']);
            }
        }else{
            //create
            $validator = Validator::make($request->all(), [
                'state_id' => 'required|numeric',
                'hours' => 'required|numeric',
                'amount' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not create shipping rate']);
            }
            $rate = ShippingRate::create(['shop_id'=> $shop->id ,'origin_id'=> $shop->state_id,'destination_id'=> $request->state_id,'hours'=> $request->hours,'amount'=> $request->amount]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Shipping Rate created successfully']);
        } 
    }


    public function notifications(Shop $shop){
        
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
