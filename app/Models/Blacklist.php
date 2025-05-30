<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blacklist extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['ipaddress','user_id','expire_at'];
}
