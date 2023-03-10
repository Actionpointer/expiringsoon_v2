<?php

namespace App\Models;

use App\Models\City;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['iso_code','name','dialing_code','flag','currency_name','currency_iso','currency_symbol'];
    
    public function getRouteKeyName(){
        return 'iso';
    }

    public function users(){
        return $this->hasMany(User::class);
    }
    public function states(){
        return $this->hasMany(State::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function cities(){
        return $this->hasManyThrough(City::class,State::class,'country_id','state_id');
    }
    public function orders(){
        return $this->hasManyThrough(Order::class,Shop::class,'country_id','shop_id');
    }

}
