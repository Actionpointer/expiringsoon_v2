<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable = ['currency_id','priceable_id','priceable_type','description','amount'];

    public function priceable(){
        return $this->morphTo();
    }
}
