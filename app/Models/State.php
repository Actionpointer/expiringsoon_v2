<?php

namespace App\Models;
use App\Models\City;
use App\Models\Rate;
use App\Models\Shop;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\Product;
use App\Models\Location;
use App\Observers\StateObserver;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name','iso','country_id'];

    public static function boot()
    {
        parent::boot();
        parent::observe(new StateObserver);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }
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
        return $this->hasMany(Rate::class,'destination_id');
    }

    public function products(){
        return $this->hasManyThrough(Product::class,Shop::class);
    }
    public function scopeWithin($query){
        if(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
                return $query->limit('10');
            else return $query->where('country_id',auth()->user()->country_id);
        }else{
            $country = session('locale')['country_id'];
            return $query->where('country_id',$country);
        }
        
    }
}
