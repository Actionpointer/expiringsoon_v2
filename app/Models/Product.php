<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Advert;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,Sluggable,SoftDeletes;

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
    
    protected $fillable = [
        'shop_id','quantity','photo','price','slug','name','status'
    ];
    protected $appends = ['amount'];

    protected $dates = ['expire_at','uploaded'];
    protected $casts = ['subcategories'=> 'array'];

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\ProductObserver);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->category->subcategories;
    }

    public function getDiscountAttribute(){
        $timeline = $this->getProductTimeline();
        $discount = 0;
        if($timeline){
            if($this['discount'.$timeline]) 
                $discount = $this['discount'.$timeline];
            elseif($this->shop['discount'.$timeline]) 
                $discount = $this->shop['discount'.$timeline];
        }
        // switch($timeline){
        //     case 30: if($this->discount30) $discount = $this->discount30;
        //             elseif($this->shop->discount30) $discount = $this->shop->discount30;
        // }
        // if($this->expire_at->diffInDays(now()) <= 30 && $this->shop->discount30)
        //     $discount = $this->shop->discount30;
        // elseif($this->expire_at->diffInDays(now()) <= 60 && $this->shop->discount60)
        //     $discount = $this-> shop->discount60;
        // elseif($this->expire_at->diffInDays(now()) <= 90 && $this-> shop->discount90)
        //     $discount = $this-> shop->discount90;
        // elseif($this->expire_at->diffInDays(now()) <= 120 && $this-> shop->discount120)
        //     $discount = $this-> shop->discount120;
        // else
        //     $discount = 0;
        return $discount;
    }

    public function getProductTimeline(){
        if($this->expire_at->diffInDays(now()) <= 30)
            return 30;
        elseif($this->expire_at->diffInDays(now()) <= 60)
            return 60;
        elseif($this->expire_at->diffInDays(now()) <= 90 && $this-> shop->discount90)
            return 90;
        elseif($this->expire_at->diffInDays(now()) <= 120 && $this-> shop->discount120)
            return 120;
        else return 0;
    }

    public function getAmountAttribute(){
        return $this->price - ($this->discount*$this->price/100);
    }
    public function adverts(){
        return $this->morphMany(Advert::class,'advertable');
    }
    public function isEdible(){
        return $this->expire_at > now();
    }
    
    public function isAccessible(){
        return $this->whereHas('shop',function ($q) { $q->where('status',true); } );
    }
    public function isAvailable(){
        return $this->stock;
    }

    public function scopeEdible($query){
        return $query->where('expire_at','>',now());
    }
    public function scopeApproved($query){
        return $query->where('status',true);
    }
    public function scopeVisible($query){
        return $query->where('visible',true);
    }
    public function scopeAccessible($query){
        return $query->whereHas('shop',function ($q) { $q->where('status',true); } );
    }
    public function scopeAvailable($query){
        return $query->where('stock','>',0);
    }
}
