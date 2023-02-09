<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;
    protected $fillable = ['currency_id','priceable_id','priceable_type','description','amount'];

    public function priceable(){
        return $this->morphTo();
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
}
