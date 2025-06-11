<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','category'];

    public function roles(){
        return Role::whereJsonContains('permissions', $this->id)->get();
    }
}
