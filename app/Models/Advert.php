<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\State;
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
        'advertable_id','advertable_type','feature_id','state_id','position','approved'
    ];
    protected $appends = ['status','running'];

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
    public function state(){
        return $this->belongsTo(State::class);
    }

    public function getStatusAttribute(){
       if($this->advertable_type == 'App\Models\Shop'){
            return $this->shop && $this->shop->certified;
       }else{
            return $this->product && $this->product->certified;
       }
    }

    public function scopeWithin($query,$state_id=null){
        if(!$state_id){
            $state_id = session('locale')['state_id'];;
        }
        return $query->where('state_id',$state_id);
    }

    public function getRunningAttribute(){
        return $this->approved && $this->feature->status && $this->feature->start_at > now() && $this->feature->end_at < now();
    }
    public function scopeRunning($query){
        return $query->where('approved',true)->whereHas('feature', function (Builder $qry) 
            { $qry->where('status',true)->where('start_at','<',now())->where('end_at','>',now()); });
    }

    public function scopeCertifiedProduct($query){
        return $query->whereHas('product', function (Builder $qry){ 
                 $qry->isValid()->isApproved()->isActive()->isVisible()->isAccessible()->isAvailable();});
    }
    public function scopeCertifiedShop($query){
        return $query->whereHas('shop', function (Builder $qry)  { 
            $qry->where('status',true)->where('approved',true)->where('published',true)
            ->whereHas('products',function(Builder $q){
                $q->isValid()->isApproved()->isActive()->isVisible()->isAccessible()->isAvailable();
            });
        });
    }

}
