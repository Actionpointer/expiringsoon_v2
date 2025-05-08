<?php

namespace App\Models;

use App\Models\Kyc;
use App\Models\City;
use App\Models\Rate;
use App\Models\Store;
use App\Models\User;
use App\Models\Adset;
use App\Models\Order;
use App\Models\State;
use App\Models\Advert;
use App\Models\Coupon;
use App\Models\Payout;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code', 'continent', 'dial', 'currency_code', 'verification_provider', 'primary_gateway', 'secondary_gateway', 'status'];
    
    
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtolower($value);
    }

    public function setCurrencyCodeAttribute($value)
    {
        $this->attributes['currency_code'] = strtolower($value);
    }

    public function getRouteKeyName(){
        return 'code';
    }

    // public function getSupportedAttribute(){
    //     if($this->banking_fields || $this->verification_fields || $this->transaction_charges || ($this->payout_type && $this->payout_type != "manual")){
    //         return true;
    //     }
    //     else return false;
    // }


    public function users(){
        return $this->hasMany(User::class);
    }
    public function stores(){
        return $this->hasMany(Store::class);
    }
    public function states(){
        return $this->hasMany(State::class);
    }
    public function coupons(){
        return $this->hasMany(Coupon::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_code','code')->withDefault([
            'code' => '','name' => '','symbol' => '','decimal_places' => 2,'decimal_name' => '','status' => 0
        ]);
    }
    public function rates(){
        return $this->hasMany(Rate::class);
    }
    public function revenues(){
        return $this->hasMany(Revenue::class);
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
    public function disputes(){
        return $this->hasManyThrough(OrderStatus::class,User::class,'country_id','user_id')->where('name','disputed');
    }
    public function payments(){
        return $this->hasManyThrough(Payment::class,User::class,'country_id','user_id');
    }
    public function payouts(){
        return $this->hasManyThrough(Payout::class,User::class,'country_id','user_id');
    }

    public function kycs(){
        return $this->hasManyThrough(Kyc::class,User::class,'country_id','user_id');
    }

}
