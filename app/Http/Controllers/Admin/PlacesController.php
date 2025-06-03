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
    
    public function index(){
        $countries = Country::all();
        $currencies = Currency::all();
        return view('backend.settings.places.index',compact('countries','currencies'));
    }

    public function country(Request $request)
    {
        if($request->country_id){
            $country = Country::find($request->country_id);
            if(!$country){
                return redirect()->back()->with(['result'=> 0,'message'=> 'Country not found']);
            }
            if($request->action == 'delete'){
                if($country->stores->count() || $country->users->count() || $country->addresses->count() || $country->states->count() || $country->cities->count()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'Country cannot be deleted']);
                }else{
                    $country->delete();
                    return redirect()->back()->with(['result'=> 1,'message'=> 'Country deleted successfully']);
                }
            }
            if($request->action == 'update'){
                $request->validate([
                    'name' => 'required|string|max:255',
                    'code' => 'required|string|max:2|unique:countries,code,' . $country->id,
                    'continent' => 'required|string',
                    'dial' => 'required|string|max:10',
                    'currency_code' => 'required|string|exists:currencies,code',
                    'verification_provider' => 'required|string',
                    'primary_gateway' => 'nullable|string',
                    'secondary_gateway' => 'nullable|string',
                    'status' => 'nullable|boolean',
                ]);
                $country->update([
                    'name' => $request->name,
                    'code' => strtoupper($request->code),
                    'continent' => $request->continent,
                    'dial' => $request->dial,
                    'currency_code' => $request->currency_code,
                    'verification_provider' => $request->verification_provider,
                    'primary_gateway' => $request->primary_gateway,
                    'secondary_gateway' => $request->secondary_gateway,
                    'status' => $request->status,
                ]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Country updated successfully']);
            }
        }else{
            $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:2|unique:countries,code',
                'continent' => 'required|string',
                'dial' => 'required|string|max:10',
                'currency_code' => 'required|string|exists:currencies,code',
                'verification_provider' => 'required|string',
                'primary_gateway' => 'nullable|string',
                'secondary_gateway' => 'nullable|string',
                'status' => 'nullable|boolean',
            ]);
            Country::create([
                'name' => $request->name,
                'code' => strtoupper($request->code),
                'continent' => $request->continent,
                'dial' => $request->dial,
                'currency_code' => $request->currency_code,
                'verification_provider' => $request->verification_provider,
                'primary_gateway' => $request->primary_gateway,
                'secondary_gateway' => $request->secondary_gateway,
                'status' => $request->status,
            ]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Country added successfully']);
        }
    }

    public function setup($value){
        //dd($value);
        $country = Country::where('iso2',strtoupper($value))->first();
        if(!$country){
            return redirect()->back()->with(['result'=> 0,'message'=> 'Country not found']);
        }
        return view('backend.settings.places.country',compact('country'));
    }

    public function state(Request $request){
        if($request->state_id){
            $state = State::find($request->state_id);
            if(!$state){
                return redirect()->back()->with(['result'=> 0,'message'=> 'State not found']);
            }
            if($request->action == 'delete'){
                if($state->stores->count() || $state->users->count() || $state->addresses->count() || $state->cities->count()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'State cannot be deleted']);
                }else{
                    $state->delete();
                    return redirect()->back()->with(['result'=> 1,'message'=> 'State deleted successfully']);
                }
            }
            if($request->action == 'update'){
                $request->validate([
                    'name' => 'required|string|max:255',
                    'status' => 'nullable|boolean',
                ]);
                $state->update([
                    'name' => $request->name,
                    'status' => $request->status,
                ]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'State updated successfully']);
            }
        }else{
            $request->validate([
                'name' => 'required|string|max:255',
                'country_id' => 'required',
                'status' => 'nullable|boolean',
            ]);
            State::create([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'status' => $request->status,
            ]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'State added successfully']);
        }
    }

    public function city(Request $request){
        if($request->city_id){
            $city = City::find($request->city_id);
            if(!$city){
                return redirect()->back()->with(['result'=> 0,'message'=> 'City not found']);
            }
            if($request->action == 'delete'){
                if($city->stores->count() || $city->users->count() || $city->addresses->count() || $city->cities->count()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'City cannot be deleted']);
                }else{
                    $city->delete();
                    return redirect()->back()->with(['result'=> 1,'message'=> 'City deleted successfully']);
                }
            }
            if($request->action == 'update'){
                $request->validate([
                    'name' => 'required|string|max:255',
                    'state_id' => 'required',
                ]);
                $city->update([
                    'name' => $request->name,
                ]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'City updated successfully']);
            }
        }else{
            $request->validate([
                'name' => 'required|string|max:255',
                'state_id' => 'required',
            ]);
            City::create([
                'name' => $request->name,
                'state_id' => $request->state_id,
            ]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'City added successfully']);
        }
    }

    public function country_basic(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $country = Country::find($request->state_id);
        $country->currency_id = $request->currency_id;
        $country->payment_gateway = $request->payment_gateway;
        $country->payout_gateway = $request->payout_gateway;
        $country->vat = $request->vat;
        $country->bank_digits = $request->bank_digits;
        $country->dimension_rate = $request->dimension_rate;
        $country->weight_rate = $request->weight_rate;
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
