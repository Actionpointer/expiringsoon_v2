<?php

namespace App\Models;

use App\Models\Gateway;
use Illuminate\Database\Eloquent\Model;

class CountryGateway extends Model
{
    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }
    
    
    
}
