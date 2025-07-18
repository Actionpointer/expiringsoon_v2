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
use App\Models\StoreUser;
use App\Models\Settlement;
use App\Models\OrderStatus;
use App\Models\OrderMessage;
use App\Models\Subscription;
use App\Models\PaymentMethod;
use App\Models\BankAccount;
use App\Observers\StoreObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory,Notifiable,Sluggable;
    
    protected $fillable = [
        'name', 'legal_business_name', 'email', 'phone', 'description', 'address',
        'country_id', 'state_id', 'city_id', 'zip_code', 'photo', 'banner',
        'contact_person', 'alt_contact_phone', 'website', 'facebook', 'instagram', 'twitter',
        'business_type', 'tax_id', 'business_registration_number', 'year_established',
        'slug', 'user_id', 'published'
    ];
    protected $appends = ['image','currency','currency_symbol'];

    public static function boot()
    {
        parent::boot();
        parent::observe(new StoreObserver);
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

    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class);
    }

    public function subscription(){
        return $this->hasMany(Subscription::class);
    }

    public function active_subscription(){
        return $this->subscription()->where('status',true)->where('start_at','<',now())->where('end_at','>',now())->first();
    }

    public function getMobileAttribute(){
        return $this->country->dial.intval($this->phone);   
    }

    public function getCurrencyAttribute(){
        return $this->country->currency_code;
    }
    
    public function getCurrencySymbolAttribute(){
        return $this->currency ? $this->country->currency_symbol:null;
    }

    public function verified(){
        return $this->addressproof && $this->addressproof->status && $this->companydoc && $this->companydoc->status && $this->user->idcard && $this->user->idcard->status;   
        // return true;
    }

    public function getImageAttribute(){
        return $this->photo ? config('app.url')."/storage/$this->photo": config('app.url').'/images/site/no-image.png';   
    }
    
    public function scopeIsApproved($query){
        return $query->where('approved',true);
    }

    public function scopeIsVisible($query){
        return $query->where('show',true);
    }

    public function scopeIsPublished($query){
        return $query->where('published',1);
    }

    public function scopeSelling($query){
        return $query->whereHas('products',function($q) {$q->live();});
    }

    public function scopeLive($query){
        $query->whereDoesntHave('rejected')->isPublished()->isApproved()->isVisible();
    }

    public function scopeIsNotCertified($query){
        return $query->where(function($q){
            $q->where('approved',false)->orWhere('show',false)->orWhere('status',0);
        });        
    }
    
    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function staff()
    {
        return $this->belongsToMany(User::class, 'store_users')->using(StoreUser::class)
                    ->withPivot('role_id','permissions', 'status','created_at')
                    ->withTimestamps();
    }

    public function activeStaff()
    {
        return $this->belongsToMany(User::class, 'store_users')
                    ->withPivot('permissions', 'status')
                    ->wherePivot('status', 'active')
                    ->withTimestamps();
    }

    // public function followers(){
    //     return $this->belongsToMany(User::class,Follow::class,'shop_id','user_id');
    // }

    
    // public function kyc(){
    //     return $this->MorphMany(Kyc::class,'verifiable');
    // }
    
    // public function addressproof(){
    //     return $this->MorphOne(Kyc::class,'verifiable')->where('type','addressproof');
    // }
    // public function certificate(){
    //     return $this->MorphOne(Kyc::class,'verifiable')->where('type','certificate');
    // }

    // public function companydocs(){
    //     return $this->MorphMany(Kyc::class,'verifiable')->where('type','companydoc');
    // }
    
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function categories(){
        $categories = $this->products->pluck('category_id');
        $categories = Category::whereIn('id',$categories)->get();
        return $categories;
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    
    // public function likes(){
    //     return $this->hasManyThrough(Like::class,Product::class,'shop_id','product_id');
    // }
    
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

    public function wallet(){
        return $this->hasOne(Wallet::class);
    }

    public function notifications()
    {
        return $this->hasOne(StoreNotification::class);
    }
}
