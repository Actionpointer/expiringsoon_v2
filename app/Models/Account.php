<?php

namespace App\Models;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'acctname','acctno','bank'
    ];
    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
