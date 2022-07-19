<?php

namespace App\Models;

use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['iso_code','name','dialing_code','flag','currency_name','currency_iso','currency_symbol'];
    public function currency(){
        return $this->hasOne(Currency::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function states(){
        return $this->hasMany(State::class);
    }
    public function cities(){
        return $this->hasManyThrough(City::class, State::class);
    }

}
