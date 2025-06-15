<?php

namespace App\Models;

use App\Models\Cost;
use App\Models\Advert;
use App\Models\Adset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adplan extends Model
{
    use HasFactory;
    protected $appends = ['price_per_day'];

    public function getPricePerDayAttribute(){
        return $this->costs->where('currency_id',session('locale')['currency_id'])->isNotEmpty() ? $this->costs->firstWhere('currency_id',session('locale')['currency_id'])->amount : 0 ;
    }
    public function costs(){
        return $this->hasMany(Cost::class);
    }
    public function adverts(){
        return $this->hasManyThrough(Advert::class,Adset::class);
    }
    public function adsets(){
        return $this->hasMany(Adset::class);
    }
    
}
