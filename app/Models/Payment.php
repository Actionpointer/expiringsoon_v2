<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\PaymentItem;
use App\Observers\PaymentObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['reference','method','user_id','currency_id','status','amount','coupon_id','coupon_value','vat'];

    public static function boot()
    {
        parent::boot();
        parent::observe(new PaymentObserver);
    }

    public function items(){
        return $this->hasMany(PaymentItem::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function getRouteKeyName(){
        return 'reference';
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


    public function getPayableAttribute(){
        return $this->amount - $this->coupon_value;
    }
}
