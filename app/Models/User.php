<?php

namespace App\Models;


use App\Models\Cart;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Order;
use App\Models\State;
use App\Models\Payout;
use App\Models\Account;
use App\Models\Address;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Settlement;
use App\Models\OrderMessage;
use App\Models\Subscription;
use App\Observers\UserObserver;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,Sluggable,HasApiTokens;

    protected $fillable = [
        'slug', 'fname','lname','email','shop_id','password','phone','country_id','role','state_id','status','require_password_change'
    ];

    protected $appends = ['balance','image','max_products','total_products','total_shops','max_shops','verified'];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot(){
        parent::boot();
        parent::observe(new UserObserver);
    }

    public function sluggable():array{
        return [
            'slug' => [
                'source' => ['fname','lname'],
                'separator' => '_'
            ]
        ];
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function getNameAttribute(){
        return ucwords($this->fname.' '.$this->lname);   
    }
    
    public function getMobileAttribute(){
        return $this->country->dial.intval($this->phone);   
    }
    public function getImageAttribute(){
        return $this->pic ? config('app.url')."/storage/$this->pic":null;  
    }
    public function getVerifiedAttribute(){
        return $this->idcard && $this->idcard->status;   
    }
    

    public function shops(){
        return $this->hasMany(Shop::class);
    }
    
    public function getBalanceAttribute(){
        return $this->shops->sum('wallet');   
    }
    public function products(){  
        return $this->hasManyThrough(Product::class,Shop::class,'user_id','shop_id');
    }
    public function shopOrders(){
        return $this->hasManyThrough(Order::class,Shop::class,'user_id','shop_id');
    } 
    public function adverts(){  
        return $this->hasManyThrough(Advert::class,Feature::class,'user_id','feature_id');
    }

    public function subscription(){
        return $this->belongsTo(Subscription::class)->withDefault();
    }
    public function getSubscriptionNameAttribute(){
        if($this->subscription_id){
            return $this->subscription->plan->name;
        }else return null;    
    }
    public function getTotalProductsAttribute(){
        if($this->shop_id)
            return $this->shop->user->products->count();
        else return $this->products->count();
    }
    public function getTotalShopsAttribute(){
        if($this->shop_id)
            return $this->shop->user->shops->count();
        else return $this->shops->count();
    }
    public function getMaxShopsAttribute(){
        if($this->shop_id)
            return $this->shop->user->subscription->plan->shops;
        elseif($this->subscription_id)
            return $this->subscription->plan->shops;
    }
    public function getMaxProductsAttribute(){
        if($this->shop_id)
            return $this->shop->user->subscription->plan->products;
        elseif($this->subscription_id)
             return $this->subscription->plan->products;
    }
    
    public function minimum_payout(){
        return $this->subscription->plan->minimum_payout;
        
    }
    public function maximum_payout(){
        return $this->subscription->plan->maximum_payout;
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function orderMessages(){
        return $this->morphOne(OrderMessage::class, 'sender');
    }
      
    public function likes(){
        return $this->hasMany(Like::class);
    }
    
    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function payouts(){
        return $this->hasMany(Payout::class);
    }

    public function bankaccount(){
        return $this->hasOne(Account::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }


    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function kyc(){
        return $this->hasMany(Kyc::class);
    }
    
    public function idcard(){
        return $this->morphOne(Kyc::class,'verifiable')->where('type','idcard');
    }

    public function features(){
        return $this->hasMany(Feature::class);
    }

    public function activeFeatures(){
        return $this->hasMany(Feature::class)->where('end_at', '>', now())->where('status',true); 
    }

    public function settlements(){
        return $this->morphMany(Settlement::class,'receiver');
    }

    public function hasAnyRole($value){
        return in_array($this->role,$value);
    }

    

}
