<?php

namespace App\Models;

use App\Models\City;
use App\Models\Rate;
use App\Models\Shop;
use App\Models\User;
use App\Models\Adset;
use App\Models\Order;
use App\Models\State;
use App\Models\Advert;
use App\Models\Coupon;
use App\Models\Payout;
use App\Models\Payment;
use App\Models\Product;
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
    public function shops(){
        return $this->hasMany(Shop::class);
    }
    public function states(){
        return $this->hasMany(State::class);
    }
    public function coupons(){
        return $this->hasMany(Coupon::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function rates(){
        return $this->hasMany(Rate::class);
    }
    public function shipments(){
        return $this->hasManyThrough(Shipment::class,Rate::class,'country_id','rate_id');
    }
    public function cities(){
        return $this->hasManyThrough(City::class,State::class,'country_id','state_id');
    }
    public function adverts(){
        return $this->hasManyThrough(Advert::class,State::class,'country_id','state_id');
    }
    public function adsets(){
        return $this->hasManyThrough(Adset::class,User::class,'country_id','user_id');
    }
    public function orders(){
        return $this->hasManyThrough(Order::class,Shop::class,'country_id','shop_id');
    }
    public function products(){
        return $this->hasManyThrough(Product::class,Shop::class,'country_id','shop_id');
    }
    public function payments(){
        return $this->hasManyThrough(Payment::class,User::class,'country_id','user_id');
    }
    public function payouts(){
        return $this->hasManyThrough(Payout::class,User::class,'country_id','user_id');
    }

}
