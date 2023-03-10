<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\User;
use App\Models\Account;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','shop_id','currency_id','channel','reference','amount','transfer_id','status',	'rejection_reason'];
    protected $appends = ['destination'];

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
    
}
