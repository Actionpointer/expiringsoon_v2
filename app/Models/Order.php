<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Shop;
use App\Models\User;
use App\Models\Address;
use App\Models\Message;
use App\Models\Product;
use App\Models\Settlement;
use App\Models\PaymentItem;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = ['slug','user_id','shop_id','address_id','delivery_fee','expected_at','subtotal','vat','total'];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => uniqid(),
                'separator' => '_'
            ]
        ];
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
        return $this->hasMany(Settlement::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function deliveryByVendor(){
        return $this->shop->shippingRates->where('destination',$this->address->state_id)->first() ? true:false;
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function commission(){
        $fixed = $this->shop->isEnterprise() ? cache('settings')['enterprise_commission_fixed'] : cache('settings')['basic_commission_fixed']; 
        $percentage = $this->shop->isEnterprise() ? cache('settings')['enterprise_commission_percentage'] : cache('settings')['basic_commission_percentage']; 
        return ($this->subtotal * ($percentage / 100)) + $fixed;
    }
    public function earning(){
        return $this->subtotal - ($this->vat + $this->commission());
    }

}
