<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Plan;
use App\Models\Shop;
use App\Models\User;
use App\Models\Address;
use App\Models\Product;
use App\Models\Settlement;
use App\Models\PaymentItem;
use App\Models\OrderMessage;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,Sluggable;
    
    protected $fillable = ['slug','user_id','shop_id','address_id','deliveryfee','expected_at','subtotal','vat','total','delivered_at'];
    protected $dates = ['expected_at','delivered_at'];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }

    public static function boot()
    {
        parent::boot();
        parent::observe(new OrderObserver);
    }

    public function getNameAttribute(){
        return uniqid();   
    }
    
    public function getRouteKeyName(){
        return 'slug';
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(Cart::class);
    }

    public function payment(){
        return $this->morphOne(PaymentItem::class,'paymentable');
    }
    public function settlement(){
        return $this->hasOne(Settlement::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function deliveryByVendor(){
        return $this->address_id && $this->shop->shippingRates->where('destination',$this->address->state_id)->first();
    }
    public function messages(){
        return $this->hasMany(OrderMessage::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function commission(){
        $plan = $this->shop->user->activeSubscription ? $this->shop->user->activeSubscription->plan : Plan::where('slug','free_plan')->first();
        $fixed = $plan->commission_fixed; 
        $percentage = $plan->commission_percentage; 
        return ($this->subtotal * ($percentage / 100)) + $fixed;
    }
    public function earning(){
        return $this->subtotal - $this->commission();
    }

}
