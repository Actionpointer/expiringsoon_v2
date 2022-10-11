<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\Feature;
use App\Models\Product;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory,SoftDeletes,GeoLocationTrait;

    protected $fillable = [
        'advertable_id','advertable_type','feature_id','status','state_id','position','approved'
    ];

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\AdvertObserver);
    }

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
    
    public function feature(){
        return $this->belongsTo(Feature::class);
    }

    public function scopeState($query,$state_id=null){
        if(!$state_id){
            $state = $this->currentState();
            $state_id = $state->id;
        }
        return $query->where('state_id',$state_id);
    }
    public function scopeRunning($query){
        return $query->where('approved',true)->where('status',true)->whereHas('feature', function (Builder $qry) 
            { $qry->where('status',true)->where('start_at','<',now())->where('end_at','>',now()); });
    }
    public function scopeCertifiedProduct($query){
        return $query->whereHas('product', function (Builder $qry){ 
                 $qry->edible()->approved()->active()->visible()->accessible()->available();});
    }
    public function scopeCertifiedShop($query){
        return $query->whereHas('shop', function (Builder $qry)  { 
            $qry->where('status',true)->where('approved',true)->where('published',true)
            ->whereHas('products',function(Builder $q){
                $q->edible()->approved()->active()->visible()->accessible()->available();
            });
        });
    }
    public function scopeApproved($query){
        return $query->where('approved',true);
    }
    public function scopeActive($query){
        return $query->where('status',true);
    }
    


}
