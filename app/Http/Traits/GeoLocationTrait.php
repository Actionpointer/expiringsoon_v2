<?php
namespace App\Http\Traits;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Location;
use App\Jobs\LocationCreateCitiesJob;
use App\Jobs\LocationCreateStatesJob;
use Illuminate\Support\Facades\Auth;

trait GeoLocationTrait
{
    

    protected function saveCountry($result){
        $country = Country::updateOrCreate(['code' => strtolower($result->country_code)],[
            'name' => $result->country_name,
            'continent' => $result->continent_name,
            'dial' => $result->calling_code,
            'verification_provider' => 'manual',
            'status' => false,
        ]);
        Location::create([
            'ip' => request()->ip(),
            'continent' => $result->continent_name,
            'country_id' => $country->id,
            'country' => $result->country_name,
            'dial' => $result->calling_code,
            'state' => $result->region,
            'city' => $result->city,
        ]);
    }   
    
}

