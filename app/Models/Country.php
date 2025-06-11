<?php

namespace App\Models;

use App\Models\Kyc;
use App\Models\City;
use App\Models\Rate;
use App\Models\User;
use App\Models\Adset;
use App\Models\Order;
use App\Models\State;
use App\Models\Store;
use App\Models\Advert;
use App\Models\Coupon;
use App\Models\Payout;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\Shipment;
use App\Models\CountryAdPlan;
use App\Models\CountryBanking;
use App\Models\CountryGateway;
use App\Models\CountryVerification;
use App\Models\CountryNewsletterPlan;
use App\Models\CountrySubscriptionPlan;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'sqlite_countries';
    protected $table = 'countries'; // adjust table name if different
    public $appends = ['active'];

    public function getRouteKeyName(){
        return 'iso2';
    }
    public function states(){
        return $this->hasMany(State::class);
    }
    public function cities(){
        return $this->hasManyThrough(City::class,State::class,'country_id','state_id');
    }

    public function users(){
        return $this->setConnection('mysql')->hasMany(User::class);
    }
    public function staff(){
        return $this->setConnection('mysql')->hasMany(User::class)->whereHas('is_admin');
    }
    public function stores(){
        return $this->setConnection('mysql')->hasMany(Store::class);
    }
    public function coupons(){
        return $this->setConnection('mysql')->hasMany(Coupon::class);
    }
    public function country_banking(){
        return $this->setConnection('mysql')->hasOne(CountryBanking::class);
    }
    public function country_gateways(){
        return $this->setConnection('mysql')->hasMany(CountryGateway::class);
    }
    public function active_gateway(){
        $gateways = $this->country_gateways()->where('status',true)->get();
        //live
        if($gateways->where('mode','live')->isNotEmpty()){
            if($gateways->where('is_primary',true)->first())
            return $gateways->where('is_primary',true)->first();
            else
            return $gateways->where('is_primary',false)->first();
        } 
        //test
        if($gateways->where('mode','test')->isNotEmpty()){
            if($gateways->where('is_primary',true)->first())
            return $gateways->where('is_primary',true)->first();
            else
            return $gateways->where('is_primary',false)->first();
        } 
    }
    public function country_subscription_plans(){
        return $this->setConnection('mysql')->hasMany(CountrySubscriptionPlan::class);
    }
    public function country_ad_plans(){
        return $this->setConnection('mysql')->hasMany(CountryAdPlan::class);
    }
    public function country_newsletter_plans(){
        return $this->setConnection('mysql')->hasMany(CountryNewsletterPlan::class);
    }
    public function country_verifications(){
        return $this->setConnection('mysql')->hasMany(CountryVerification::class);
    }
    public function getActiveAttribute(){
        return $this->country_banking && $this->country_subscription_plans->count() && $this->country_ad_plans->count() && $this->country_newsletter_plans->count() && $this->country_verifications->count();
    }
    
    
    
    
    public function rates(){
        return $this->setConnection('mysql')->hasMany(Rate::class);
    }
    public function revenues(){
        return $this->setConnection('mysql')->hasMany(Revenue::class);
    }
    public function shipments(){
        return $this->setConnection('mysql')->hasManyThrough(Shipment::class,Rate::class,'country_id','rate_id');
    }
    
    public function adverts(){
        return $this->setConnection('mysql')->hasManyThrough(Advert::class,State::class,'country_id','state_id');
    }
    public function adsets(){
        return $this->setConnection('mysql')->hasManyThrough(Adset::class,User::class,'country_id','user_id');
    }
    public function orders(){
        return $this->setConnection('mysql')->hasManyThrough(Order::class,Store::class,'country_id','store_id');
    }
    public function products(){
        return $this->setConnection('mysql')->hasManyThrough(Product::class,Store::class,'country_id','store_id');
    }
    public function disputes(){
        return $this->setConnection('mysql')->hasManyThrough(OrderStatus::class,User::class,'country_id','user_id')->where('name','disputed');
    }
    public function payments(){
        return $this->setConnection('mysql')->hasManyThrough(Payment::class,User::class,'country_id','user_id');
    }
    public function payouts(){
        return $this->setConnection('mysql')->hasManyThrough(Payout::class,User::class,'country_id','user_id');
    }

    public function kycs(){
        return $this->setConnection('mysql')->hasManyThrough(Kyc::class,User::class,'country_id','user_id');
    }

}
