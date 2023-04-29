<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\User;
use App\Models\Address;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\Settlement;
use App\Models\OrderStatus;
use App\Models\PaymentItem;
use App\Models\OrderDispute;
use App\Models\OrderMessage;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,Sluggable;
    
    protected $fillable = ['slug','user_id','shop_id','address_id','deliveryfee','deliverer','expected_at','subtotal','vat','total','delivered_at'];
    protected $dates = ['expected_at','delivered_at'];
    protected $appends = ['status'];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }

    public function statuses(){
        return $this->hasMany(OrderStatus::class);
    }
    
    public function getStatusAttribute(){
        return $this->statuses->sortByDesc('created_at')->first()->name;
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
    
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function payment_item(){
        return $this->morphOne(PaymentItem::class,'paymentable');
    }
    
    public function settlements(){
        return $this->hasMany(Settlement::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }
    
    public function scopeStatusFilter($query,$value){    
        return $query->whereHas('statuses',function($q) use($value){
            $q->where('name',$value);
        });
    }
    
    public function messages(){
        return $this->hasMany(OrderMessage::class);
    }

    public function dispute(){
        return $this->hasOne(OrderDispute::class);
    }
    
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function shipments(){
        return $this->hasMany(Shipment::class);
    }

    public function commission(){
        $plan = $this->shop->user->subscription ? $this->shop->user->subscription->plan : Plan::where('slug','free_plan')->first();
        $fixed = $plan->commission_fixed; 
        $percentage = $plan->commission_percentage; 
        return ($this->subtotal * ($percentage / 100)) + $fixed;
    }

    public function earning(){
        return $this->subtotal - $this->commission();
    }

    public function arbitrator(){
        return $this->belongsTo(User::class,'arbitrator_id');
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

}
