<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CountryVerification extends Pivot
{
    protected $guarded = ['id'];
    protected $table = 'country_verifications';
    protected $fillable = ['country_id','verification_provider_id','id_requirement','address_requirement','business_requirement','additional_requirement','id_documents','address_documents','business_documents','additional_documents'];
    protected $casts = ['id_documents'=> 'array', 'address_documents'=> 'array', 'business_documents'=> 'array', 'additional_documents'=> 'array'];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function verificationProvider()
    {
        return $this->belongsTo(VerificationProvider::class);
    }
    
    
    
}
