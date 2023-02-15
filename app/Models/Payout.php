<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','shop_id','channel','destination','reference','amount','transfer_id','status'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function account(){
        return $this->belongsTo(Account::class);
    }
}
