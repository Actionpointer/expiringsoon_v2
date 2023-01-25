<?php
namespace App\Http\Traits;
use App\Models\State;
use App\Models\Country;
use App\Models\Location;
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
    protected function getState($country_id,$state){
        $state = State::where('country_id',$country_id)->where('name','LIKE',"%".$state."%")->first();
        return $state;
    }

    public function saveLocation($geo_location){
        $country = $this->getCountryByIso($geo_location['geoplugin_countryCode']);
        $state = $this->getState($country->id,$geo_location['geoplugin_region']);
        if($country && $state){
            $location = Location::updateOrCreate([
                'ipaddress'=> $geo_location['geoplugin_request'],
                'country_id'=> $country->id,
                'user_id'=> auth()->check() ? auth()->id() : null,
                'state_id'=> $state->id
            ]);
            return $location;
        }else return null;
        
    }

    public function getLocation($ip){
        return Location::where('ipaddress',$ip)->first();
    }

    
    
}

