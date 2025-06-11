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
        'user_id','account_number','bank_id','branch_id','status'
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
