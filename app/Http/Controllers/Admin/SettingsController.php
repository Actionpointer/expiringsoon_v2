<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Plan;
use App\Models\User;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Support\Arr;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    use GeoLocationTrait,SecurityTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $users = User::whereNotIn('role',['shopper','vendor'])->get();
        $countries = Country::all();
        $states = State::all();
        $plans = Plan::all();
        $adplans = Adplan::all();
        $settings = Setting::all();
        $rates = ShippingRate::whereNull('shop_id')->get();
        $currencies = Currency::all();
        return view('admin.settings',compact('plans','adplans','currencies','users','countries','settings','rates','states'));
    }

    public function store(Request $request){
        
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        foreach($request->except('_token') as $key => $value){
            Setting::where('name',$key)->update(['value'=> $value]);
        }
        Cache::forget('settings');
        $settings = Cache::rememberForever('settings', function () {
            return \App\Models\Setting::select(['name','value'])->get()->pluck('value','name')->toArray();
        });
        return redirect()->back()->with(['result'=>1,'message'=> 'Settings Saved']);
    }

    public function country_basic(Request $request){
        dd($request->all());
        $country = Country::find($request->country_id);
        $country->currency_id = $request->currency_id;
        $country->payment_gateway_receiving = $request->payment_gateway_receiving;
        $country->payment_gateway_transfering = $request->payment_gateway_transfering;
        $country->vat = $request->vat;
        $country->bank_digits = $request->bank_digits;
        return redirect()->back()->with(['result'=> 1,'message'=> 'Udpated Country Settings']);
    }

    public function admins(Request $request){
        
        if($request->user_id){
            if($request->delete){
                $user = User::destroy($request->user_id);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted User']);
            }else{
                //update
                // dd($request->all());
                $user = User::find($request->user_id);
                $validator = Validator::make($request->all(), [
                    'fname' => 'nullable|string',
                    'lname' => 'nullable|string',
                    'status' => 'nullable|numeric',
                    'role' => 'nullable|string',
                    'email' => ['nullable',Rule::unique('users')->ignore($user)],
                    'phone' => ['nullable',Rule::unique('users')->ignore($user)],
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not update user']);
                }
                $user = User::where('id',$request->user_id)->update(['fname'=> $request->fname,'lname'=> $request->lname,'status'=> $request->status,'role'=> $request->role,'email'=> $request->email,'phone'=> $request->phone]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated User']);
            }
        }else{
            //create
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string',
                'lname' => 'required|string',
                'status' => 'required|numeric',
                'role' => 'required|string',
                'email' => 'required|string|unique:users',
                'phone' => 'required|string|unique:users',
                'password' => 'required','string','confirmed'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
            }
            $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'status'=> $request->status,'role'=> $request->role,'state_id'=> session('locale')['state_id'],'country_id'=> session('locale')['country_id'],'email'=> $request->email,'phone'=> $request->phone,'password'=> Hash::make($request->password)]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'User created successfully']);
        }   
    }
    
    public function plans(Request $request){
        if($request->plan_id){
            if($request->delete){
                $plan = Plan::find($request->plan_id);
                if($plan->activeSubscriptions->isEmpty()){
                    $plan->delete();
                    return redirect()->back()->with(['result'=> 1,'message'=> 'Plan Deleted Successfully']);
                }else return redirect()->back()->with(['result'=> 0,'message'=> 'Unable to delete plan which has active subscriptions']);
            }else{
                $plan = Plan::where('id',$request->plan_id)->update(['name'=> $request->name,'description'=>  $request->description,'products'=> $request->products,'shops'=> $request->shops,'months_1'=> $request->months_1,'months_3'=> $request->months_3,'months_6' => $request->months_6,'months_12' => $request->months_12]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Plan Updated Successfully']);
            }
        }else{
            $plan = Plan::create(['name'=> $request->name,'description'=>  $request->description,'products'=> $request->products,'shops'=> $request->shops,'months_1'=> $request->months_1,'months_3'=> $request->months_3,'months_6' => $request->months_6,'months_12' => $request->months_12]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Plan Created Successfully']);
        }
    }

    public function adplans(Request $request){  
        foreach($request->price_per_day as $key=>$price){
            $adplan = Adplan::where('id',$key)->update(['price_per_day'=> $price]);
        }
        return redirect()->back()->with(['result'=> 1,'message'=> 'Updated advert plan successfully']);
    }
    
    public function categories(){
        $categories = Category::all();
        $tags = Tag::all();
        // dd($tags);
        return view('admin.categories',compact('categories','tags'));
    }

    public function categories_management(Request $request){
        if($request->category_id){
            $category = Category::find($request->category_id);
            if($request->delete){
                if($category->products->count()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'Unable to delete category which has products']);
                }
                $category->subcategories->detach();
                $category->delete();

                
            }else{
                $category->name = $request->category;
                $category->save();
                $old_subs = Arr::where($request->tags, function ($value, $key) {
                    return is_numeric($value) ;
                });
                $new_subs = Arr::where($request->tags, function ($value, $key) {
                    return is_string($value);
                });
                $category->subcategories->sync($old_subs);
                foreach($new_subs as $sub){
                    $newtag = Tag::create(['name'=> $sub]);
                    $category->subcategories->attach($newtag->id);
                }
            }
        }else{
            $category = Category::create(['name'=> $request->category]);
            foreach($request->tags as $tag){
                if(is_numeric($tag)){
                    $category->subcategories->attach($tag);
                }else{
                    $newtag = Tag::create(['name'=> $tag]);
                    $category->subcategories->attach($newtag->id);
                }
            }
        }
    }

    
    
    

    
    
    
    
}
