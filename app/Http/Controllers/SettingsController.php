<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\State;
use App\Models\Plan;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Arr;
use App\Models\ShippingRate;
use App\Models\Subcategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;



class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users = User::whereNotIn('role',['shopper','vendor'])->get();
        $countries = Country::all();
        $states = State::within()->get();
        $plans = Plan::all();
        $settings = Setting::all();
        $rates = ShippingRate::whereNull('shop_id')->get();
        return view('admin.settings',compact('plans','users','countries','settings','rates','states'));
    }
    public function settings(Request $request){
        foreach($request->except('_token') as $key => $value){
            if($request->country_id){
                $country = Country::find($request->country_id);
                Setting::where('name','country')->update(['value'=> $country->name]);
                Setting::where('name','country_iso')->update(['value'=> $country->iso]);
                Setting::where('name','dialing_code')->update(['value'=> $country->dial]);
                Setting::where('name','currency_name')->update(['value'=> $country->currency_name]);
                Setting::where('name','currency_iso')->update(['value'=> $country->currency_iso]);
                Setting::where('name','currency_symbol')->update(['value'=> $country->currency_symbol]);
            }
            Setting::where('name',$key)->update(['value'=> $value]);
        }
        Cache::forget('settings');
        $settings = Cache::rememberForever('settings', function () {
            return \App\Models\Setting::select(['name','value'])->get()->pluck('value','name')->toArray();
        });
        return redirect()->back();
    }

    public function storeAdmin(Request $request){
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // $dial = 
        $user = User::create(['fname'=> explode(' ',$request->name)[0],'lname'=> explode(' ',$request->name)[1],'role'=> $request->role,'email'=> $request->email,'phone_prefix'=> cache('settings')['dialing_code'] ,'phone'=> $request->phone,'password'=> Hash::make($request->password)]);
        return redirect()->back();
    }

    public function updateAdmin(Request $request){
        $user = User::find($request->user_id);
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => ['nullable',Rule::unique('users')->ignore($user)],
            'phone' => ['nullable',Rule::unique('users')->ignore($user)],
            'password' => 'nullable','string','confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->filled('name')){
            $user->fname = explode(' ',$request->name)[0];
            $user->lname = explode(' ',$request->name)[1];
        }
        if($request->filled('phone')){
            $user->phone = $request->phone;
            $user->phone_prefix = cache('settings')['dialing_code'];
        } 
        if($request->filled('role')) $user->role = $request->role;
        if($request->filled('email')) $user->email = $request->email;
        if($request->filled('password')) $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back();
    }

    public function destroyAdmin(Request $request){
        $user = User::where('id',$request->user_id)->delete();
        return redirect()->back();
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
            if($request->action == 'update'){
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
            }else{
                if($category->products->count()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'Unable to delete category which has products']);
                }
                $category->subcategories->detach();
                $category->delete();
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
