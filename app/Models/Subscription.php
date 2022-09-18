<?php

namespace App\Models;

use App\Models\User;
use App\Models\Advert;
use App\Models\Plan;
use App\Models\PaymentItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','plan_id','amount','start_at','end_at'];
    
    protected $dates = ['start_at','end_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->morphOne(PaymentItem::class,'paymentable');
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function getDurationAttribute(){
        return $this->start_at->diffInMonths($this->end_at);   
    }

    public function expiring(){
        switch($this->duration){
            case '1': return $this->start_at < now() && $this->end_at > now() && $this->end_at->diffInDays(now()) < 7;
                break;
            case '3': return $this->start_at < now() && $this->end_at > now() && $this->end_at->diffInDays(now()) < 21;
                break;
            case '6': return $this->start_at < now() && $this->end_at > now() && $this->end_at->diffInDays(now()) < 30;
                break;
            case '12': return $this->start_at < now() && $this->end_at > now() && $this->end_at->diffInDays(now()) < 45;
                break;
        }
    }

    public function active(){
        return $this->start_at < now() && $this->end_at > now() && $this->status;
    }

    public function expired(){
        return $this->start_at < now() && $this->end_at < now();
    }

    public function scopeActiveSubscription($query){
        return $query->where('status',true)->where('start_at','<',now())->where('end_at','>',now());
    }

}
