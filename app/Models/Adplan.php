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
