<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Advert;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    
    protected $fillable = ['name','shop_id','slug','description','stock','category_id','published','status', 'tags','photo','expire_at','price','discount30','discount60','discount90','discount120'];
    protected $appends = ['amount','image','discount'];

    protected $dates = ['expire_at','uploaded'];
    protected $casts = ['tags'=> 'array'];

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
                $discount = 100 * ($this->price - $this['discount'.$timeline]) / $this->price;
            elseif($this->shop['discount'.$timeline]) 
                $discount = $this->shop['discount'.$timeline];
        }
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
    public function getImageAttribute(){
        return $this->photo ? config('app.url')."/storage/$this->photo":null;  
    }
    public function adverts(){
        return $this->morphMany(Advert::class,'advertable');
    }

    public function isValid(){
        return $this->expire_at > now();
    }
    public function isAvailable(){
        return $this->stock > cache('settings')['minimum_stock_level'];
    }
    
    public function isAccessible(){
        return $this->shop->status && $this->shop->approved && $this->shop->published;
    }

    public function isCertified(){
        return $this->isValid() && $this->isAccessible() && $this->approved && $this->status && $this->published && $this->isAvailable();
    }
    public function scopeWithinCountry($query){
        return $query->whereHas('shop',function ($q) { $q->where('country_id',session('locale')['country_id']); } );
    }
    public function scopeValid($query){
        return $query->where('expire_at','>',now());
    }
    public function scopeApproved($query){
        return $query->where('approved',true);
    }
    public function scopeActive($query){
        return $query->where('status',true);
    }
    public function scopeVisible($query){
        return $query->where('published',true);
    }
    public function scopeAccessible($query){
        return $query->whereHas('shop',function ($q) { $q->where('status',true)->where('approved',true)->where('published',true); } );
    }
    public function scopeAvailable($query){
        return $query->where('stock','>',cache('settings')['minimum_stock_level']);
    }
    
    public function reviews(){
        return $this->morphMany(Review::class,'reviewable');
    }
}
