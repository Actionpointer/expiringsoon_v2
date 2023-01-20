<?php
namespace App\Http\Traits;
use App\Models\State;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

trait GeoLocationTrait
{
    protected function currentState(){
        $current_state = auth()->check() && auth()->user()->state_id ? auth()->user()->state->name : session('locale')['state'];
        $state = State::where('name',$current_state)->first();
        return $state;
    }

    protected function getLocale(Location $location){
        return [
            'country_id'=> $location->country->id,
            'country_name'=> $location->country->name,
            'country_iso'=> $location->country->iso,
            'state'=> $location->state->name,
            'dial'=> $location->country->dial,
            'currency_id'=> $location->country->currency_id,
            'currency_name'=> $location->country->currency->name,
            'currency_symbol'=> $location->country->currency->symbol,  
        ];
    }

    protected function getCountryByIso($iso){
        $country = Country::where('iso',$iso)->first();
        return $country;
    }

    public function saveLocation($geo_location){
        $country = $this->getCountryByIso($geo_location['geoplugin_countryCode']);
        $state = $this->getState($country->id,$geo_location['geoplugin_region']);
        $location = Location::updateOrCreate([
                    'ipaddress'=> $geo_location['geoplugin_request'];
                    'country_id'=> $geo_location['geoplugin_countryName'],
                    'user_id'=> $geo_location['geoplugin_countryCode'],
                    'country_id'=> $this->getCountryByIso($geo_location['geoplugin_countryCode'])->id,
                    'country_id'=> $this->getCountryByIso($geo_location['geoplugin_countryCode'])->id,
                    'state'=> $state->id
                ]);
        return $location;
    }

    public function getLocation($ip){
        return Location::where('ipaddress',$ip)->first();
    }

    
    
}

