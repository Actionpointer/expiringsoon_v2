<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = ['name','code', 'start_at', 'end_at',  'quantity', 'available', 'is_percentage',  'value',  'limit_per_user',  'status', 'maximum_spend', 'minimum_spend'];
    protected $dates = ['start_at','end_at'];
}
