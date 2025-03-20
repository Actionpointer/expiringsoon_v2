<?php

namespace App\Models;

use App\Models\BankingProvider;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CountryBanking extends Pivot
{
    protected $guarded = ['id'];
    protected $casts = ['fields'=> 'array'];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function bankingProvider()
    {
        return $this->belongsTo(BankingProvider::class);
    }
    
    
    
}
