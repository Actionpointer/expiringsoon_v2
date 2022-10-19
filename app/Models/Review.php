<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['reviewable_id','reviewable_type','order_id','rating','comment','report'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
