<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\State;
use App\Models\Adset;
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
        'advertable_id','advertable_type','adset_id','state_id','position','approved','photo','heading','subheading','offer'
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
    
    public function adset(){
        return $this->belongsTo(Adset::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function getStatusAttribute(){
       if($this->advertable_type == 'App\Models\Shop'){
            return $this->shop && $this->shop->certified();
       }else{
            return $this->product && $this->product->certified();
       }
    }

    public function scopeWithinState($query,$state_id=null){
        if(!$state_id){
            $state_id = session('locale')['state_id'];;
        }
        return $query->where('state_id',$state_id);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('state',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('state',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('state',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }

    public function getRunningAttribute(){
        return $this->approved && $this->adset->status && $this->adset->start_at < now() && $this->adset->end_at > now();
    }
    
    public function scopeRunning($query){
        return $query->where('approved',true)->whereHas('adset', function (Builder $qry) 
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
