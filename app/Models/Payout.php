<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\User;
use App\Models\Account;
use App\Models\Currency;
use App\Observers\PayoutObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','shop_id','currency_id','channel','reference','amount','transfer_id','status',	'paid_at'];
    protected $appends = ['destination'];
    protected $casts = ['paid_at'=> 'datetime'];

    public static function boot(){
        parent::boot();
        parent::observe(new PayoutObserver);
    }
    
    public function getRouteKeyName(){
        return 'reference';
    }

    public function getDestinationAttribute(){
        return in_array($this->user->country->payout_gateway,['stripe','paypal']) ? $this->user->payout_account : $this->user->bankaccount->bank->name.' '.$this->user->bankaccount->account_number;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
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
    
}
