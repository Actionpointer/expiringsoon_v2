<?php
namespace App\Http\Traits;
use App\Models\State;
use Illuminate\Support\Facades\Auth;

trait GeoLocationTrait
{
    protected function currentState(){
        $current_state = auth()->check() && auth()->user()->state_id ? auth()->user()->state->name : session('geo_locale')['state'];
        $state = State::where('name',$current_state)->first();
        return $state;
    }
    
}

