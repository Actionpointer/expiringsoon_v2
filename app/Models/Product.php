<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Advert;
use App\Models\Review;
use App\Models\Category;
use App\Models\OrderItem;
use App\Observers\ProductObserver;
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
    protected $appends = ['amount','image','discount','valid','available'];

    // protected $dates = ['expire_at'];
    protected $casts = ['tags'=> 'array','expire_at'=> 'datetime'];

    public static function boot()
    {
        parent::boot();
        parent::observe(new ProductObserver);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function orders(){
        return $this->hasMany(OrderItem::class);
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
        $timeline = $this->timeline;
        $discount = 0;
        if($timeline){
            if($this['discount'.$timeline]) 
                $discount = 100 * ($this->price - $this['discount'.$timeline]) / $this->price;
            elseif($this->shop['discount'.$timeline]) 
                $discount = $this->shop['discount'.$timeline];
        }
        return $discount;
    }

    public function getTimelineAttribute(){
        if($this->expire_at->diffInDays(now()) <= 30)
            return 30;
        elseif($this->expire_at->diffInDays(now()) <= 60)
            return 60;
        elseif($this->expire_at->diffInDays(now()) <= 90)
            return 90;
        elseif($this->expire_at->diffInDays(now()) <= 120)
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

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('shop',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('shop',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('shop',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }
    //expiry
    public function getValidAttribute(){
        return $this->expire_at->subHours(cache('settings')['order_processing_to_delivery_period']) > now();
    }

    public function scopeIsValid($query){
        return $query->where('expire_at','>',now()->addHours(cache('settings')['order_processing_to_delivery_period']));
    }
    
    public function certified(){
        return $this->valid && $this->accessible() && $this->approved && $this->status && $this->published && $this->available;
    }

    public function scopeIsNotCertified($query){
        return $query->where(function($q){
            $q->where('approved',false)->orWhere('status',false)->orWhere('published',false)->orWhere('expire_at','<',now()->addHours(cache('settings')['order_processing_to_delivery_period']));
        });        
    }

    public function scopeIsApproved($query){
        return $query->where('approved',true);
    }
    
    public function scopeIsActive($query){
        return $query->where('status',true);
    }
    public function scopeIsVisible($query){
        return $query->where('published',true);
    }
    //accessible
    public function accessible(){
        return $this->shop->status && $this->shop->approved && $this->shop->published;
    }
    public function scopeIsAccessible($query){
        return $query->whereHas('shop',function ($q) { $q->where('status',true)->where('approved',true)->where('published',true); } );
    }
    //available
    public function getAvailableAttribute(){
        return $this->stock > cache('settings')['minimum_stock_level'];
    }
    public function scopeIsAvailable($query){
        return $query->where('stock','>',cache('settings')['minimum_stock_level']);
    }
    
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function reviewable(){
        $result = false;
        if(auth()->check()){
            $order = Order::where('user_id',auth()->id())->whereHas('statuses')->whereHas('items',function($query){
                $query->where('product_id',$this->id);
            })->count();
            if($order && $this->reviews->where('user_id',auth()->id())->isEmpty()){
                $result = true;                
            }
        }
        return $result;
    }

    public function ratings(){
        $count = $this->reviews->count();
        $sum = $this->reviews->sum('rating');
        if($count){
            return $sum/$count;
        }else return 0;
        
    }
}
