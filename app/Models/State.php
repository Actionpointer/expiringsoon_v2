<?php

namespace App\Models;
use App\Models\City;
use App\Models\Rate;
use App\Models\Store;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\Product;
use App\Models\Location;
use App\Observers\StateObserver;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name','country_id'];

    
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }
    public function stores(){
        return $this->hasMany(Store::class);
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
        return $this->hasMany(Rate::class,'destination_id');
    }

    public function products(){
        return $this->hasManyThrough(Product::class,Store::class);
    }
    
}
