<?php

namespace App\Models;

// use PDO;
use App\Models\Cart;
use App\Models\Like;
use App\Models\Store;
use App\Models\Advert;
use App\Models\Review;
use App\Models\Feature;
use App\Models\OrderItem;
use App\Models\Rejection;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
    
    protected $fillable = ['store_id','name','slug','description','category_id',
    'published','approved_at','tags','photos','expire_at','expiry_term',
    'discount30','discount60','discount90','discount120'];

    protected $appends = ['amount','image','discount','valid','available','expiry_in','fault'];
    protected $casts = ['expire_at'=> 'datetime','approved_at'=> 'datetime','photos'=> 'array', 'published' => 'boolean', 'always_available' => 'boolean', 'preorder' => 'boolean',];

    public static function boot()
    {
        parent::boot();
        parent::observe(new ProductObserver);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
        );
    }
    public function getLengthWithUnitAttribute(){
        return $this->length ? $this->length.$this->units[0] : '';
    }
    public function getWidthWithUnitAttribute(){
        return $this->width ? $this->length.$this->units[0] : '';
    }
    public function getHeightWithUnitAttribute(){
        return $this->height ? $this->length.$this->units[0] : '';
    }
    public function getWeightWithUnitAttribute(){
        return $this->weight ? $this->length.$this->units[1] : '';
    }

    public function currency_values(){
        return $this->belongsTo(Currency::class,'currency','code');
    }

    // public function likes(){
    //     return $this->hasMany(Like::class);
    // }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function orders(){
        return $this->hasMany(OrderItem::class);
    }
    // public function shop(){
    //     return $this->belongsTo(Shop::class);
    // }
    public function categories(){
        $categories = collect([]);
        foreach($this->tags as $tag){
            $tg = Tag::where('name',$tag)->first();
            if($tg) $categories->push($tg->categories);
        }
        return $categories->unique('id')->flatten();
    }


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
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

    public function getExpiryInAttribute(){
        if(!$this->expire_at)
        return 0;
        else
        return $this->expire_at->diffInDays(now());
    }

    public function getTimelineAttribute(){
        if($this->expiry_in <= 30)
            return 30;
        elseif($this->expiry_in <= 60)
            return 60;
        elseif($this->expiry_in <= 90)
            return 90;
        elseif($this->expiry_in <= 120)
            return 120;
        else return 0;
    }

    //expiry
    public function getValidAttribute(){
        $hours = cache('settings')['order_processing_to_delivery_period'] + cache('settings')['order_delivered_to_acceptance_period'];
        return $this->expire_at && $this->expire_at->subHours($hours) > now() ? true:false;
    }

    public function scopeIsValid($query){
        $hours = cache('settings')['order_processing_to_delivery_period'] + cache('settings')['order_delivered_to_acceptance_period'];
        return $query->where('expire_at','>',now()->addHours($hours));
    }

    public function getAmountAttribute(){
        return $this->price - ($this->discount*$this->price/100);
    }

    public function getImageAttribute(){
        return $this->photo ? config('app.url')."/storage/$this->photo": config('app.url')."/images/site/no-image.png";  
    }

    public function adverts(){
        return $this->morphMany(Advert::class,'advertable');
    }

    public function rejections(){
        return $this->morphMany(Rejection::class,'rejectable');
    }

    public function rejected(){
        return $this->morphOne(Rejection::class,'rejectable');
    }

    public function features(){
        return $this->hasMany(Feature::class);
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

    public function scopeIsNotCertified($query){
        return $query->where(function($q){
            $q->where('approved',false)->orWhere('show',false)->orWhere('published',false)->orWhere('expire_at','<',now()->addHours(cache('settings')['order_processing_to_delivery_period']));
        });        
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

    public function scopeIsAvailable($query){
        return $query->where('stock','>',cache('settings')['minimum_stock_level']);
    }

    public function scopeIsNotRejected($query){
        return $query->doesntHave('rejected');
    }

    //accessible
    // public function accessible(){
    //     return $this->shop->status && $this->shop->approved && $this->shop->published;
    // }

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

    public function scopeLive($query){
        return $query->whereDoesntHave('rejected')->isPublished()->isAvailable()->isValid()->isApproved()->isVisible();
    }

    public function scopeIsAccessible($query){
        return $query->whereHas('shop',function ($q) { $q->live(); } );
    }

    //available
    public function getAvailableAttribute(){
        return $this->stock > cache('settings')['minimum_stock_level'];
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

    public function getVisibilityAttribute(){
        if($this->shop->user->max_products >= $this->shop->user->total_products && $this->shop->status == 'live'){
            return true;
        }else return false;
    }

    public function getPublishableAttribute(){
        if($this->rejected){
            return 0;
        }
        if(!$this->discount30 || !$this->discount60 || !$this->discount90 || !$this->discount120 || !$this->valid || !$this->available || !$this->photo || !$this->tags || !$this->length || !$this->width || !$this->height || !$this->weight){
            return 0;
        }
        if($this->discount30 > $this->price || $this->discount30 > $this->discount60 || $this->discount60 > $this->discount90 || $this->discount90 > $this->discount120){
            return 0;
        }
        return 1;
    }

    public function getFaultAttribute(){
        if(!$this->discount30)
        return 'Discount in 30days must be specified';
        elseif(!$this->discount60)
        return 'Discount in 60days must be specified'; 
        elseif(!$this->discount90)
        return 'Discount in 90days must be specified';
        elseif(!$this->discount120)
        return 'Discount in 120days must be specified';
        elseif(!$this->expire_at)
        return 'Expiry date must be specified';
        elseif(!$this->valid)
        return 'Expiry date period is not acceptable';
        elseif(!$this->photo)
        return 'Product must have image';
        elseif(!$this->stock)
        return 'Product stock quantity must be greater than '.cache('settings')['minimum_stock_level'];
        elseif(!$this->tags)
        return 'Atleast one tag is required for product';
        elseif(!$this->length || !$this->width || !$this->height || !$this->weight)
        return 'Product Dimensions must be specified';
        elseif($this->discount30 > $this->price)
        return 'The 30days discount price must be less than actual price';
        elseif($this->discount30 > $this->discount60)
        return 'The 30days discount price must be less than 60days discount price';
        elseif($this->discount60 > $this->discount90)
        return 'The 60days discount price must be less than 90days discount price';
        elseif($this->discount90 > $this->discount120)
        return 'The 90days discount price must be less than 120days discount price';
        elseif(!$this->published) return 'Product is in draft mode';
        else return '';
    }

    
}
