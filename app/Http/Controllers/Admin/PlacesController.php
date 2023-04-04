<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;

class PlacesController extends Controller
{
    use SecurityTrait;
    
    public function country(Country $country){
        $currencies = Currency::all();
        return view('admin.settings.country',compact('country','currencies'));
    }

    public function country_basic(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
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
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
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
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
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

    public function state_manage(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $state = State::find($request->state_id);
        if($request->action == 'delete'){
            if($state->shops->count() || $state->users->count() || $state->addresses->count() || $state->locations->count() || $state->cities->count() || $state->rates->count()){
                return redirect()->back()->with(['result'=> 0,'message'=> 'State cannot be deleted']);
            }else{
                $state->delete();
                return redirect()->back()->with(['result'=> 1,'message'=> 'State deleted successfully']);
            }
        }else{
            $state->name = $request->name;
            $state->save();
            return redirect()->back()->with(['result'=> 1,'message'=> 'State updated successfully']);
        }
    }

    public function city_manage(Request $request){

        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $city = City::find($request->city_id);
        if($request->action == 'delete'){
            if($city->shops->count() || $city->users->count() || $city->addresses->count() || $city->locations->count() ){
                return redirect()->back()->with(['result'=> 0,'message'=> 'City cannot be deleted']);
            }else{
                $city->delete();
                return redirect()->back()->with(['result'=> 1,'message'=> 'City deleted successfully']);
            }
        }else{
            $city->name = $request->name;
            $city->save();
            return redirect()->back()->with(['result'=> 1,'message'=> 'City updated successfully']);
        }
        
    }

    
}
