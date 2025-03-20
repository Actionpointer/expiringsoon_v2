<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CountryVerification extends Pivot
{
    protected $guarded = ['id'];
    protected $table = 'country_verifications';
    protected $casts = ['id_documents'=> 'array', 'address_documents'=> 'array', 'business_documents'=> 'array', 'finance_documents'=> 'array'];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function verificationProvider()
    {
        return $this->belongsTo(VerificationProvider::class);
    }
    
    
    
}
