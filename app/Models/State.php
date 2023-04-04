<?php

namespace App\Models;
use App\Models\City;
use App\Models\Shop;
use App\Models\User;
use App\Models\Address;
use App\Models\Product;
use App\Models\Location;
use App\Models\Rate;
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
            $country = auth()->user()->role->name == 'superadmin' ? true: auth()->user()->country_id;
        }else{
            $country = session('locale')['country_id'];
        }
        return $query->where('country_id',$country);
    }
}
