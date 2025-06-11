<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrySubscriptionPlan extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = ['country_id', 'name',
            'slug',
            'description',
            'products',
            'staff',
            'storage_mb',
            'commission',
            'minimum_withdrawal',
            'maximum_withdrawal',
            'withdrawal_interval',
            'withdrawal_count',
            'newsletter_credits',
            'monthly_price',
            'annual_price',
            'is_public',
            'is_default',
            'is_active'];
    

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }
}
