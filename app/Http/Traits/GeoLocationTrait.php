<?php
namespace App\Http\Traits;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Location;
use App\Jobs\CreateCitiesJob;
use App\Jobs\CreateStatesJob;
use Illuminate\Support\Facades\Auth;

trait GeoLocationTrait
{
    // protected function currentState(){
    //     $current_state = auth()->check() && auth()->user()->state_id ? auth()->user()->state->name : session('locale')['state'];
    //     $state = State::where('name',$current_state)->first();
    //     return $state;
    // }

    protected function getLocale(Location $location= null){
        if(!$location){
            $location = Location::where('ipaddress','197.211.58.12')->first();
        }
        return [
            'country_id'=> $location->country->id,
            'country_name'=> $location->country->name,
            'country_iso'=> $location->country->iso,
            'state_name'=> $location->state->name,
            'state_id'=> $location->state->id,
            'dial'=> $location->country->dial,
            'currency_id'=> $location->country->currency_id,
            'currency_iso'=> $location->country->currency->iso,
            'currency_name'=> $location->country->currency->name,
            'currency_symbol'=> $location->country->currency->symbol,  
        ];
    }

    protected function getCountryByIso($iso){
        $country = Country::where('iso',$iso)->first();
        return $country;
    }
    protected function getState($country_id,$state_name,$state_code){
        // $state = State::where('country_id',$country_id)->where('name','LIKE',"%".$state_name."%")->first();
        $state = State::where('country_id',$country_id)->where('iso',$state_code)->first();
        if(!$state){
            $state = State::create(['country_id'=> $country_id,'iso'=> $state_code,'name'=> $state_name]);
            CreateStatesJob::dispatch($country_id);
        }
        return $state;
    }
    protected function getCity($country_id,$state_id,$city_name){
        // $state = State::where('country_id',$country_id)->where('name','LIKE',"%".$state_name."%")->first();
        $city = City::where('state_id',$state_id)->where('name',$city_name)->first();
        if(!$city){
            $city = City::create(['country_id'=> $country_id,'state_id'=> $state_id,'name'=> $city_name]);
            CreateCitiesJob::dispatch($country_id,$state_id);
        }
        return $city;
    }

    public function saveLocation($geo_location){
        $country = $this->getCountryByIso($geo_location['geoplugin_countryCode']);
        $state = $this->getState($country->id,$geo_location['geoplugin_region'],$geo_location['geoplugin_regionCode']);
        $city = $this->getCity($country->id,$state->id,$geo_location['geoplugin_city']);
        if($country && $state && $city){
            $location = Location::updateOrCreate([
                'ipaddress'=> $geo_location['geoplugin_request'],
                'country_id'=> $country->id,
                'user_id'=> auth()->check() ? auth()->id() : null,
                'state_id'=> $state->id,
                'city_id'=> $city->id
            ]);
            return $location;
        }else return null;
        
    }

    public function getLocation($ip){
        return Location::where('ipaddress',$ip)->first();
    }

    
    
}

