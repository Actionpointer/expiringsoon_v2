<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class ShippingRate extends Model
{
    use HasFactory;
    protected $fillable = ['shop_id','origin_id','destination_id','hours','amount'];
    public function origin(){
        return $this->belongsTo(State::class,'origin_id');
    }
    public function destination(){
        return $this->belongsTo(State::class,'destination_id');
    }
}
