<?php

namespace App\Models;

use App\Models\Price;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function prices(){
        return $this->morphMany(Price::class,'priceable');
    }
    
}
