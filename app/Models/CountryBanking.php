<?php

namespace App\Models;

use App\Models\BankingProvider;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CountryBanking extends Pivot
{
    protected $table = 'country_bankings';
    protected $guarded = ['id'];
    protected $casts = ['banking_fields'=> 'array','transaction_charges'=> 'array',
    'withdrawal_charges'=> 'array'];
    
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
    
}
