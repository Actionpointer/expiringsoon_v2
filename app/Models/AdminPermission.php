<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminPermission extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','permissions','status'];

    protected $casts = [
        'permissions'=> 'array',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
