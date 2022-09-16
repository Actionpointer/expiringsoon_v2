<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory,Sluggable,SoftDeletes;
    
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }

    protected $fillable = ['name','description','products','shops','months_1','months_3','months_6','months_12'];
    public function getRouteKeyName(){
        return 'slug';
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
    public function activeSubscriptions(){
        return $this->hasMany(Subscription::class)->where('end_at', '>', now())->where('status',true);
    }
}
