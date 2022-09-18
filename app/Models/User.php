<?php

namespace App\Models;


use App\Models\Cart;
use App\Models\Like;
use App\Models\Plan;
use App\Models\Shop;
use App\Models\Order;
use App\Models\State;
use App\Models\Payout;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Settlement;
use App\Models\Subscription;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,Sluggable;

    protected $fillable = [
        'slug', 'fname','lname','email', 'password','phone_prefix','phone','country_id','role','state_id'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sluggable():array
    {
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
    public function getNameAttribute()
    {
        return ucwords($this->fname.' '.$this->lname);   
    }
    public function getMobileAttribute()
    {
        return $this->phone_prefix.intval($this->phone);   
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
    public function likes(){
        return $this->hasMany(Like::class);
    }
    
    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function payouts(){
        return $this->hasMany(Payout::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function shops(){
        return $this->belongsToMany(Shop::class)->withPivot('role','status');
    }

    public function products(){  
        return $this->hasManyThrough(Product::class,ShopUser::class,'user_id','shop_id');
    }

    public function staff(){
        return $this->hasMany(ShopUser::class);
    }

    // public function kyc(){
    //     return $this->morphOne(Kyc::class,'owner');
    // }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription(){
        return $this->hasOne(Subscription::class)->where('end_at', '>', now())->where('status',true); 
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
