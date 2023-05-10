<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\User;
use App\Models\Advert;
use App\Models\PaymentItem;
use App\Observers\SubscriptionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','plan_id','amount','start_at','renew_at','end_at','auto_renew','coupon','status'];
    protected $appends = ['active','duration','is_free'];
    protected $casts = ['start_at','end_at','renew_at'];

    public static function boot()
    {
        parent::boot();
        parent::observe(new SubscriptionObserver);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment_item(){
        return $this->morphOne(PaymentItem::class,'paymentable');
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function getDurationAttribute(){
        return $this->start_at->diffInMonths($this->end_at);   
    }

    public function getActiveAttribute(){
        return  $this->start_at < now() && $this->end_at > now() && $this->status;
    }
    public function getIsFreeAttribute(){
        return  !$this->renew_at && !$this->end_at;
    }

    public function expired(){
        return $this->start_at < now() && $this->end_at < now();
    }
    
    public function scopeExpired($query){
        return $query->where('start_at','<',now())->where('end_at','<',now());
    }

}
