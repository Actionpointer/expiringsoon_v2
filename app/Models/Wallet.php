<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['owner_id','owner_type','balance','currency_code','status'];
    //protected $appends = ['orphan'];

    public function owner(){
        return $this->morphTo();
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function getBalanceAttribute()
    {
        return $this->decryptBalance();
    }

    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $this->encryptBalance($value);
    }

    public function getBalance()
    {
        return $this->decryptBalance();
    }

    public function hasFunds()
    {
        return $this->decryptBalance() > 0;
    }

    protected function encryptBalance($value)
    {
        return encrypt($value);
    }

    protected function decryptBalance()
    {
        if (empty($this->attributes['balance'])) {
            return 0;
        }

        try {
            return decrypt($this->attributes['balance']);
        } catch (\Exception $e) {
            return 0;
        }
    }
    
    
}
