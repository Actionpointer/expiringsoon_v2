<?php

namespace App\Models;

use App\Models\Price;
use App\Models\Advert;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adplan extends Model
{
    use HasFactory;
    protected $appends = ['price_per_day'];

    public function getPricePerDayAttribute(){
        return $this->prices->where('currency_id',session('locale')['currency_id'])->where('description','price_per_day')->isNotEmpty() ? $this->prices->where('currency_id',session('locale')['currency_id'])->firstWhere('description','price_per_day')->amount : 0 ;
    }
    public function adverts(){
        return $this->hasManyThrough(Advert::class,Feature::class);
    }
    public function features(){
        return $this->hasMany(Feature::class);
    }
    public function prices(){
        return $this->morphMany(Price::class,'priceable');
    }
}
