<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];

    public function roles(){
        return $this->belongsToMany(Role::class,'permission_roles')->withPivot('list','view','edit','new','remove');
    }
}
