<?php

namespace App\Models;

use App\Models\Kyc;
use App\Models\Cart;
use App\Models\City;
use App\Models\Rate;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Advert;
use App\Models\Follow;
use App\Models\Payout;
use App\Models\Review;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rejection;
use App\Models\Settlement;
use App\Models\OrderStatus;
use App\Models\PackageRate;
use App\Models\OrderMessage;
use App\Observers\ShopObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory,Notifiable,Sluggable;
    
    protected $fillable = ['name','slug','user_id','email','phone','banner','address','country_id','state_id','city_id','published','show','dimension_rate','weight_rate'];
    protected $appends = ['image'];

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
    
    public function getRouteKeyName(){
        return 'slug';
    }

    public function getMobileAttribute(){
        return $this->country->dial.intval($this->phone);   
    }

    public function verified(){
        return $this->addressproof && $this->addressproof->status && $this->companydoc && $this->companydoc->status && $this->user->idcard && $this->user->idcard->status;   
        // return true;
    }

    public function getImageAttribute(){
        return $this->banner ? config('app.url')."/storage/$this->banner": config('app.url').'/src/images/site/no-image.png';   
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->where('country_id',$value);
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->where('country_id',auth()->user()->country_id);
        }else{
            return $query->where('country_id',session('locale')['country_id']);
        }  
    }
    
    public function scopeIsApproved($query){
        return $query->where('approved',true);
    }

    public function scopeIsVisible($query){
        return $query->where('show',true);
    }

    public function scopeIsPublished($query){
        return $query->where('published',true);
    }

    public function scopeSelling($query){
        return $query->whereHas('products',function($q) {$q->live();});
    }
    
    public function certified(){
        return $this->show && $this->approved && $this->published;
    }

    public function scopeLive($query){
        $query->whereDoesntHave('rejected')->isPublished()->isApproved()->isVisible();
    }

    public function getPublishableAttribute(){
        if($this->rejected || $this->rates->isEmpty() || !$this->dimension_rate || !$this->weight_rate || !$this->banner){
            return 0;
        }
        return 1;
    }

    public function getStatusAttribute(){
        if($this->rejected)
        return 'rejected';
        elseif(!$this->publishable)
        return 'inactive';
        elseif(!$this->approved)
        return 'pending';
        elseif(!$this->show)
        return 'hidden';
        else return 'live';
    }

    public function getFaultAttribute(){
        if(!$this->weight_rate || !$this->dimension_rate)
        return 'Package rate must be set to enable product shipping';
        elseif($this->rates->isEmpty())
        return 'Atleast one shipment destination must be set'; 
        elseif(!$this->banner)
        return 'Shop banner must be set';
        elseif(!$this->published) return 'Shop is in draft mode';
        else return '';
    }

    public function scopeIsNotCertified($query){
        return $query->where(function($q){
            $q->where('approved',false)->orWhere('show',false)->orWhere('published',false);
        });        
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class,Follow::class,'shop_id','user_id');
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
    public function certificate(){
        return $this->MorphOne(Kyc::class,'verifiable')->where('type','certificate');
    }

    public function companydocs(){
        return $this->MorphMany(Kyc::class,'verifiable')->where('type','companydoc');
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
    
    public function rates(){
        return $this->hasMany(Rate::class);
    }

    public function categories(){
        $categories = $this->products->pluck('category_id');
        $categories = Category::whereIn('id',$categories)->get();
        return $categories;
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    
    public function likes(){
        return $this->hasManyThrough(Like::class,Product::class,'shop_id','product_id');
    }
    
    public function adverts(){
        return $this->morphMany(Advert::class,'advertable');
    }
    public function features(){
        return $this->hasManyThrough(Feature::class,Product::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function orderStatuses(){
        return $this->hasManyThrough(OrderStatus::class,Order::class,'shop_id','order_id');
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

    public function rejections(){
        return $this->morphMany(Rejection::class,'rejectable');
    }

    public function rejected(){
        return $this->morphOne(Rejection::class,'rejectable');
    }

    
    
}
