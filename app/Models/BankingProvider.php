<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankingProvider extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['regions'=> 'array'];
    
    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_banking')
            ->withPivot('status', 'verification_required', 'mode')
            ->withTimestamps();
    }
} 