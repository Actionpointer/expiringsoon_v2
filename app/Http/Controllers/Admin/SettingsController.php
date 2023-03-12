<?php

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Cost;
use App\Models\Plan;
use App\Models\User;
use App\Models\Price;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
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
        $users = User::whereDoesntHave('role',function($query){ $query->whereIn('name',['shopper','vendor','staff']);})->get();
        $countries = Country::all();
        $states = State::all();
        $plans = Plan::all();
        $adplans = Adplan::all();
        $settings = Setting::all();
        
        $currencies = Currency::all();
        return view('admin.settings.global',compact('plans','adplans','currencies','users','countries','settings','states'));
    }

    public function country(Country $country){
        $currencies = Currency::all();
        return view('admin.settings.country',compact('country','currencies'));
    }
    public function plan(Plan $plan){
        $currencies = Currency::all();
        // dd($plan->prices);
        return view('admin.settings.plan',compact('plan','currencies'));
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
        
        $country = Country::find($request->country_id);
        $country->currency_id = $request->currency_id;
        $country->payment_gateway = $request->payment_gateway;
        $country->payout_gateway = $request->payout_gateway;
        $country->vat = $request->vat;
        $country->bank_digits = $request->bank_digits;
        $country->save();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Udpated Country Settings']);
    }

    public function country_states(Request $request){
        $country = Country::find($request->country_id);
        if($request->type == 'manual' && $request->states){
            foreach(explode(',',$request->states) as $line){
                if(strpos($line,':') === false)
                continue;
                $state = State::updateOrCreate(['iso'=> explode(':',$line)[0],'country_id'=> $country->id],['name'=> explode(':',$line)[1]]);
            }
        }else{
            $responses = Curl::to("https://api.countrystatecity.in/v1/countries/$country->iso/states")
            ->withHeader('X-CSCAPI-KEY: '.config('services.countrystatecity'))
            ->asJson()
            ->get();
            foreach($responses as $response){
                $state = State::updateOrCreate(['iso'=> $response->iso2,'country_id'=> $country->id],['name'=> $response->name]);
            }
        }
        return redirect()->back()->with(['result'=> 1,'message'=> 'Udpated Country States']);
    }

    public function country_cities(Request $request){
        $country = Country::find($request->country_id);
        $state = Country::find($request->state_id);
        if($request->type == 'manual' && $request->cities){
            foreach(explode(',',$request->cities) as $line){
                if($line){
                    $city = State::updateOrCreate(['state_id'=> $state->id,'name'=> $line]);
                }   
            }
        }else{
            $responses = Curl::to("https://api.countrystatecity.in/v1/countries/$country->iso/states/$state->iso/cities")
            ->withHeader('X-CSCAPI-KEY: '.config('services.countrystatecity'))
            ->asJson()
            ->get();
            foreach($responses as $response){
                $city = City::updateOrCreate(['state_id'=> $state->id,'name'=> $response->name]);
            }
        }
        return redirect()->back()->with(['result'=> 1,'message'=> 'Udpated Country States']);
    }
    
    public function plans(Request $request){
        $plan = Plan::where('id',$request->plan_id)->update(['name'=> $request->name,'description'=>  $request->description,'products'=> $request->products,'shops'=> $request->shops,'months_1'=> $request->months_1,'months_3'=> $request->months_3,'months_6' => $request->months_6,'months_12' => $request->months_12]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Plan Updated Successfully']);
    }

    public function plan_pricing(Request $request){
        // dd('here');
        $price = Price::updateOrCreate(['plan_id'=> $request->plan_id,'currency_id'=> $request->currency_id],[
        'minimum_payout'=> $request->minimum_payout,'maximum_payout'=> $request->maximum_payout,
        'commission_percentage'=> $request->commission_percentage,'commission_fixed'=> $request->commission_fixed,
        'months_1'=> $request->months_1,'months_3'=> $request->months_3,
        'months_6'=> $request->months_6,'months_12'=> $request->months_12]);
        
        
        return redirect()->back()->with(['result'=> 1,'message'=> 'Prices Updated Successfully']);
    }


    public function adplans(Request $request){  
        $plan = AdPlan::where('id',$request->adplan_id)->update(['name'=> $request->name,'description'=>  $request->description]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Updated advert plan successfully']);
    }

    public function ad_pricing(Request $request){
        // dd($request->all());
        foreach($request->currencies as $currency){
            $cost = Cost::updateOrCreate(['adplan_id'=> $request->adplan_id,'currency_id'=> $currency],['amount'=> $request->amount[$currency] ]); 
        }
        return redirect()->back()->with(['result'=> 1,'message'=> 'Prices Updated Successfully']);
    }

    public function logistics(){
        $countries = Country::all();
        $states = State::all();
        $rates = ShippingRate::whereNull('shop_id')->get();
        
        return view('admin.settings.logistics',compact('rates','countries','states'));
    }
    
    

    
    
    

    
    
    
    
}
