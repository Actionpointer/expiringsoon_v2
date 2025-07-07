<?php

namespace App\Models;

use App\Models\User;
use App\Models\Store;
use App\Models\BankAccount;
use App\Observers\PayoutObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','store_id','currency_code','channel','reference','amount','transfer_id','status',	'paid_at'];
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

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function account(){
        return $this->belongsTo(BankAccount::class);
    }
    
    
}
