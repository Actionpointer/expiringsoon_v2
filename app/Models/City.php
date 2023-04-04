<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\User;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use App\Models\Location;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name','state_id'];

    public function state(){
        return $this->belongsTo(State::class);
    }

    // public function country(){
    //     return $this->belongsTo(State::class)->belongsTo(Country::class);
    // }

    public function shops(){
        return $this->hasMany(Shop::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function locations(){
        return $this->hasMany(Location::class);
    }
    public function addresses(){
        return $this->hasMany(Address::class);
    }
    public function rates(){
        return $this->hasMany(Rate::class);
    }

}
