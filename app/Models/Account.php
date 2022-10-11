<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\BankBranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'shop_id', 'account_name','account_number','bank_id','branch_id','status'
    ];
    public function bank(){
        return $this->belongsTo(Bank::class);
    }
    public function branch(){
        return $this->belongsTo(BankBranch::class);
    }
}
