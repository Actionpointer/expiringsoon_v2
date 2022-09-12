<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'advertable_id','advertable_type','subscription_id','boost','plus','vip','status','state_id'
    ];
    public function advertable(){
        return $this->morphTo();
    }
    public function product(){
        //use only after separating the product from the shop
        return $this->belongsTo(Product::class,'advertable_id');
    }
    public function shop(){
        //use only after separating the product from the shop
        return $this->belongsTo(Shop::class,'advertable_id');
    }
    
    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

    public function scopeState($query,$state_id){
        return $query->where('state_id',$state_id);
    }
    public function scopeRunning($query){
        return $query->whereHas('subscription', function (Builder $qry) 
            { $qry->where('status',true)->where('start_at','<',now())->where('end_at','>',now()); });
    }
    public function scopeActiveProduct($query){
        return $query->whereHas('product', function (Builder $qry) 
                { $qry->edible()->approved()->visible()->accessible()->available();});
    }
    public function scopeActiveShop($query){
        return $query->whereHas('shop', function (Builder $qry)  { $qry->where('status',1);});
    }
    


}
