<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTrail extends Model
{

    protected $fillable = ['support_id','user_id','status'];
}
