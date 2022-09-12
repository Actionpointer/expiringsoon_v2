<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','body','product_id','order_id'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
