<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\Adset;
use App\Models\State;
use App\Models\Product;
use App\Observers\AdvertObserver;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory,GeoLocationTrait;

    protected $fillable = [
        'advertable_id','advertable_type','adset_id','state_id','approved','photo','heading','subheading',
        'offer','text_color','button_text','button_color','rejection_reason'
    ];
    //status means the state (not status) of the shop/product .e.g availability, approval, accessibility, etc
    protected $appends = ['status','running','image'];

    
    public static function boot()
    {
        parent::boot();
        parent::observe(new AdvertObserver);
    }
    
    public function advertable(){
        return $this->morphTo();
    }

    public function product(){
        //use only after separating the product from the shop
        return $this->belongsTo(Product::class,'advertable_id');
    }

    public function rejections(){
        return $this->morphMany(Rejection::class,'rejectable');
    }

    public function rejected(){
        return $this->morphOne(Rejection::class,'rejectable');
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

    public function getRunningAttribute(){
        return $this->approved && $this->status && $this->adset->status && $this->adset->start_at < now() && $this->adset->end_at > now();
    }

    public function getStatusAttribute(){
        return $this->advertable && $this->advertable->certified();
    }
    
    public function getUrlAttribute(){
        return route('advert.click',$this);
    }

    public function getImageAttribute(){
        return $this->photo ? config('app.url')."/storage/$this->photo":null;  
    }

    public function scopeWithinState($query,$state_id=null){
        if(!$state_id){
            if(auth()->check()){
                $state_id = auth()->user()->state_id;
            }else{
                $state_id = session('locale')['state_id'];
            }
            
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
            $qry->isActive()->isApproved()->isVisible()
            ->whereHas('products',function(Builder $q){
                $q->isValid()->isAccessible()->isAvailable()->isActive()->isApproved()->isVisible();
            });
        });
    }

}
