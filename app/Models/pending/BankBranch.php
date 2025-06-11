<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankBranch extends Model
{
    use HasFactory;

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
    public function accounts(){
        return $this->hasMany(Account::class);
    }
}
