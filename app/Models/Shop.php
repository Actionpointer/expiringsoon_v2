<?php

namespace App\Models;

use App\Models\Kyc;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Advert;
use App\Models\Payout;
use App\Models\Review;
use App\Models\Account;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\Settlement;
use App\Models\OrderMessage;
use App\Models\ShippingRate;
use App\Observers\ShopObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory,Notifiable,Sluggable;
    
    protected $fillable = ['name','slug','user_id','email','phone','banner','address','country_id','state_id','city_id','published','status'];
    protected $appends = ['image','verified'];

    public static function boot()
    {
        parent::boot();
        parent::observe(new ShopObserver);
    }

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }
    // public function routeNotificationForNexmo($notification)
    // {
    //     return $this->mobile;
    // }
    public function getRouteKeyName(){
        return 'slug';
    }
    public function getMobileAttribute(){
        return $this->country->dial.intval($this->phone);   
    }
    public function getVerifiedAttribute(){
        return $this->addressproof && $this->addressproof->status && $this->companydoc && $this->companydoc->status;   
    }

    public function getImageAttribute(){
        return $this->banner ? config('app.url')."/storage/$this->banner":null;   
    }
    public function scopeNative($query){
        return $query->where('country_id',session('locale')['country_id']);
    }
    public function scopeApproved($query){
        return $query->where('approved',true);
    }
    public function scopeVisible($query){
        return $query->where('published',true);
    }
    public function scopeActive($query){
        return $query->where('status',true);
    }
    public function scopeSelling($query){
        return $query->whereHas('products',function($q) {$q->where('status',true)->where('published',true)->where('approved',true);});
    }
    public function isCertified(){
        return $this->status && $this->approved && $this->published;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function staff(){
        return $this->hasMany(User::class);
    }
    public function kyc(){
        return $this->MorphMany(Kyc::class,'verifiable');
    }
    
    public function addressproof(){
        return $this->MorphOne(Kyc::class,'verifiable')->where('type','addressproof');
    }
    public function companydoc(){
        return $this->MorphOne(Kyc::class,'verifiable')->where('type','companydoc');
    }
    
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function bankaccount(){
        return $this->hasOne(Account::class);
    }
    public function shippingRates(){
        return $this->hasMany(ShippingRate::class);
    }
    public function categories(){
        $categories = $this->products->pluck('category_id');
        $categories = Category::whereIn('id',$categories)->get();
        return $categories;
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    
    public function adverts(){
        return $this->morphMany(Advert::class,'advertable');
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
    
    public function payouts(){
        return $this->hasMany(Payout::class);
    }
    
    public function settlements(){
        return $this->morphMany(Settlement::class,'receiver');
    }

    public function reviews(){
        return $this->morphMany(Review::class,'reviewable');
    }
    public function ratings(){
        if($this->morphMany(Review::class,'reviewable')->count())
        return $this->morphMany(Review::class,'reviewable')->sum('rating') / $this->morphMany(Review::class,'reviewable')->count();
        else return 0;
    }
    
}
