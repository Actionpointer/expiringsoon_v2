<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = ['store_id','name','code', 'start_at', 'end_at',  'quantity', 'available', 'is_percentage', 'value',  'limit_per_user', 'role', 'published', 'maximum_spend', 'minimum_spend','country_id'];
    protected $casts = ['start_at'=> 'datetime','end_at'=> 'datetime'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('within', function (Builder $builder) {
            if (!auth()->user()) {
                $builder->where('country_id', auth()->user()->country_id);
            }
        });
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
