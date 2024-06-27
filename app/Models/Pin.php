<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;

    protected $fillable = ['body','user_id','last_updated_at'];
    protected $casts = ['last_updated_at'=> 'datetime'];
}
