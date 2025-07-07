<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\User;
use App\Models\BankBranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'store_id','gateway','gateway_reference','banking_fields','account_status','primary_account','verified_at'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }
    public function bank(){
        return $this->belongsTo(Bank::class);
    }
    public function branch(){
        return $this->belongsTo(BankBranch::class)->withDefault([
            'code' => '',
        ]);
    }
}
