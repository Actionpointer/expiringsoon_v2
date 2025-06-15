<?php

namespace App\Http\Controllers\Admin;


use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\CountryAdPlan;
use App\Models\CountryBanking;
use App\Models\CountryGateway;
use App\Http\Traits\SecurityTrait;
use App\Models\CountryVerification;
use App\Http\Controllers\Controller;
use App\Models\CountryNewsletterPlan;
use App\Models\CountrySubscriptionPlan;
use App\Models\Gateway;

class CountryController extends Controller
{
    use SecurityTrait;
    
    public function index(){
        $countries = Country::all();
        return view('backend.settings.countries.index',compact('countries'));
    }

    public function financials($value){
        $country = Country::where('iso2',strtoupper($value))->first();
        $country_gateways = CountryGateway::where('country_id',$country->id)->get();
        $country_banking = CountryBanking::where('country_id',$country->id)->first();
        $gateways = Gateway::all();
        return view('backend.settings.countries.financials',compact('country','country_gateways','country_banking','country','gateways'));
    }

    public function financial_gateway(Request $request){
        CountryGateway::updateOrCreate(['gateway_id'=> $request->gateway_id,'country_id'=> $request->country_id],['is_primary'=> $request->is_primary,'status'=> $request->status,'mode'=> $request->mode]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Gateway settings updated successfully']);
    }

    public function financial_banking(Request $request){
        //dd($request->all());
        CountryBanking::updateOrCreate(['country_id'=> $request->country_id],$request->except(['country_id','_token']));
        return redirect()->back()->with(['result'=> 1,'message'=> 'Gateway settings updated successfully']);
    }

    public function subscription_plan(Country $country){
        $subscription_plan = CountrySubscriptionPlan::where('country_id',$country->id)->get();
        return view('backend.settings.countries.subscription-plans',compact('country','subscription_plan'));
    }

    public function store_subscription_plan(Request $request){
        CountrySubscriptionPlan::create($request->all());
        return redirect()->back();
    }

    public function update_subscription_plan(Request $request){
        CountrySubscriptionPlan::where('id',$request->plan_id)->update($request->except(['plan_id','_token']));
        return redirect()->back()->with(['result'=> 1,'message'=> 'Subscription plan settings updated successfully']);
    }

    public function ad_plan(Country $country){
        $adPlans = CountryAdPlan::where('country_id',$country->id)->get();
        return view('backend.settings.countries.ad-plans',compact('country','adPlans'));
    }

    public function updateAdPlan(Request $request){
        $country = Country::where('iso2',strtoupper($request->country))->first();
        $country_ad_plan = CountryAdPlan::where('country_id',$country->id)->get();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Ad plan settings updated successfully']);
    }

    public function newsletter_plan(Country $country){
        $newsletterPlans = CountryNewsletterPlan::where('country_id',$country->id)->get();
        return view('backend.settings.countries.newsletter-plans',compact('country','newsletterPlans'));
    }

    public function updateNewsletterPlan(Request $request){
        $country = Country::where('iso2',strtoupper($request->country))->first();
        $country_newsletter_plan = CountryNewsletterPlan::where('country_id',$country->id)->get();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Newsletter plan settings updated successfully']);
    }


    public function verifications($value){
        $country = Country::where('iso2',strtoupper($value))->first();
        $country_verification = CountryVerification::where('country_id',$country->id)->get();
        return view('backend.settings.countries.verifications',compact('country','country_verification','country'));
    }

    public function updateVerification(Request $request){
        $country = Country::where('iso2',strtoupper($request->country))->first();
        $country_verification = CountryVerification::where('country_id',$country->id)->get();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Verification settings updated successfully']);
    }
     
}
