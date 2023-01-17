<?php

namespace App\Models;

use App\Models\User;
use App\Models\Adplan;
use App\Observers\FeatureObserver;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory,Sluggable,SoftDeletes;
    
    protected $fillable = ['user_id','slug','adplan_id','units','amount','start_at','end_at','auto_renew'];
    protected $appends = ['active'];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }
    public static function boot()
    {
        parent::boot();
        parent::observe(new FeatureObserver);
    }

    public function getNameAttribute()
    {
        return uniqid();   
    }
    public function getDurationAttribute(){
        return $this->start_at->diffInMonths($this->end_at);   
    }
    public function getActiveAttribute(){
        return $this->start_at < now() && $this->end_at > now() && $this->status;
    }
    
    public function getRouteKeyName(){
        return 'slug';
    }
    protected $dates = ['start_at','end_at'];

    public function adplan(){
        return $this->belongsTo(Adplan::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function adverts(){
        return $this->hasMany(Advert::class);
    }

    
    public function expired(){
        return $this->start_at < now() && $this->end_at < now();
    }
    public function expiring(){
        return $this->start_at < now() && $this->end_at > now() && $this->end_at->diffInDays(now()) < 3;
    }
    public function scopeExpired($query){
        return $query->where('start_at','<',now())->where('end_at','<',now());
    }

}
