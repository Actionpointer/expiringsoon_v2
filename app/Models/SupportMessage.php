<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;
    protected $fillable = ['support_id','user_id','body','attachments','read_at'];
    protected $casts = ['attachments'=> 'array','read_at'=> 'datetime'];
}
