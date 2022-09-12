<?php

namespace App\Models;
use App\Models\City;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name','code','country_id'];

    public function cities(){
        return $this->hasMany(City::class);
    }
    public function shops(){
        return $this->hasMany(Shop::class);
    }
    public function products(){
        return $this->hasManyThrough(Product::class,Shop::class);
    }
    public function scopeWithin($query){
        $country = cache('settings')['country_id'];
        return $query->where('country_id',$country);
    }
}
