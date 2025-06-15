<?php

namespace App\Models;

use App\Models\Permission;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = ['name','description','type','permissions','status'];
    protected $casts = ['permissions'=> 'array'];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }

    public function role_permissions(){
        return Permission::whereIn('id',$this->permissions)->get();
    }
}
