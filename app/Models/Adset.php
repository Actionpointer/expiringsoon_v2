<?php

namespace App\Models;

use App\Models\User;
use App\Models\Adplan;
use App\Models\Feature;
use App\Models\PaymentItem;
use App\Observers\AdsetObserver;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adset extends Model
{
    use HasFactory,Sluggable,SoftDeletes;
    
    protected $fillable = [
        'store_id', 'campaign_id', 'country_ad_plan_id', 'slug', 'start_at', 'end_at', 'units', 'amount', 'status',
        'auto_renew', 'targeting', 'daily_budget', 'pricing_model', 'schedule'
    ];
    protected $casts = ['start_at'=> 'datetime','end_at'=> 'datetime'];
    protected $appends = ['active'];

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
        parent::observe(new AdsetObserver);
    }

    public function getNameAttribute()
    {
        return uniqid();   
    }
    public function getDurationAttribute(){
        return $this->start_at->diffInMonths($this->end_at);   
    }
    public function getActiveAttribute(){
        return $this->start_at < now() && $this->end_at > now() && $this->status;
    }
    
    public function getRouteKeyName(){
        return 'slug';
    }
    

    public function adplan(){
        return $this->belongsTo(Adplan::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function adverts(){
        return $this->hasMany(Advert::class);
    }

    public function features(){
        return $this->hasMany(Feature::class);
    }
    
    public function payment_item(){
        return $this->morphOne(PaymentItem::class,'paymentable');
    }

    
    public function expired(){
        return $this->start_at < now() && $this->end_at < now();
    }
    
    public function expiring(){
        return $this->start_at < now() && $this->end_at > now() && $this->end_at->diffInDays(now()) < 3;
    }

    public function scopeExpired($query){
        return $query->where('start_at','<',now())->where('end_at','<',now());
    }

    public function scopeActive($query){
        return $query->where('start_at','<',now())->where('end_at','>',now())->where('status',true);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('user',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('user',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('user',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }

    public function plan()
    {
        return $this->belongsTo(CountryAdPlan::class, 'country_ad_plan_id');
    }
}
