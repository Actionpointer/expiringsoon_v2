<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryAdPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id', 'name', 'description', 'instruction', 
        'type', 'width', 'height', 'price_fixed','price_cpc','price_cpm', 'placement', 'format', 
        'device_desktop','device_mobile','device_tablet','duration_daily','duration_weekly','duration_monthly','is_active'
    ];
    
}
