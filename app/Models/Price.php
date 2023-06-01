<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;
    protected $fillable = ['currency_id','plan_id','minimum_payout','maximum_payout','commission_percentage','commission_fixed','shipment_percentage','shipment_fixed','months_1','months_3','months_6','months_12'];

    public function priceable(){
        return $this->morphTo();
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
}
