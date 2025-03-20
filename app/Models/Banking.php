<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    protected $guarded = [];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function bankingProvider(){
        return $this->belongsTo(BankingProvider::class);
    }
    
}
