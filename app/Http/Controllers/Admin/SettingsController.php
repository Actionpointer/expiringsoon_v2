<?php

namespace App\Http\Controllers\Admin;



use App\Models\Cost;
use App\Models\Plan;
use App\Models\User;
use App\Models\Price;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    use GeoLocationTrait,SecurityTrait;

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        // $users = User::whereDoesntHave('role',function($query){ $query->whereIn('name',['shopper','vendor','staff']);})->get();
        $countries = Country::all();
        $plans = Plan::all();
        $adplans = Adplan::all();
        $settings = Setting::all();
        $currencies = Currency::all();
        return view('admin.settings.global',compact('plans','adplans','currencies','countries','settings'));
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
        return redirect()->back()->with(['result'=> 1,'message'=> 'Settings Saved']);
    }

    public function plan(Plan $plan){
        $currencies = Currency::all();
        // dd($plan->prices);
        return view('admin.settings.plan',compact('plan','currencies'));
    }
     
    public function plans(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $plan = Plan::where('id',$request->plan_id)->update(['name'=> $request->name,'description'=>  $request->description,'products'=> $request->products,'shops'=> $request->shops,'months_1'=> $request->months_1,'months_3'=> $request->months_3,'months_6' => $request->months_6,'months_12' => $request->months_12]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Plan Updated Successfully']);
    }

    public function plan_pricing(Request $request){
        // dd('here');
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $price = Price::updateOrCreate(['plan_id'=> $request->plan_id,'currency_id'=> $request->currency_id],[
        'minimum_payout'=> $request->minimum_payout,'maximum_payout'=> $request->maximum_payout,
        'commission_percentage'=> $request->commission_percentage,'commission_fixed'=> $request->commission_fixed,
        'shipment_percentage'=> $request->shipment_percentage,'shipment_fixed'=> $request->shipment_fixed,
        'months_1'=> $request->months_1,'months_3'=> $request->months_3,
        'months_6'=> $request->months_6,'months_12'=> $request->months_12]);
        
        
        return redirect()->back()->with(['result'=> 1,'message'=> 'Prices Updated Successfully']);
    }

    public function adplans(Request $request){  
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $plan = AdPlan::where('id',$request->adplan_id)->update(['name'=> $request->name,'description'=>  $request->description]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Updated advert plan successfully']);
    }

    public function ad_pricing(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        foreach($request->currencies as $currency){
            $cost = Cost::updateOrCreate(['adplan_id'=> $request->adplan_id,'currency_id'=> $currency],['amount'=> $request->amount[$currency] ]); 
        }
        return redirect()->back()->with(['result'=> 1,'message'=> 'Prices Updated Successfully']);
    }
    
    

    
    
    

    
    
    
    
}
