<?php

namespace App\Models;

use App\Models\User;
use App\Models\Place;
use App\Models\Store;
use App\Models\Profile;
use App\Models\Rejection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'name',
        'document',
        'issue_date',
        'expiry_date',
        'approved_at',
        'approved_by',
        'status',
        'comments',
    ];
    protected $casts = ['approved_at'=> 'datetime'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function approver(){
        return $this->belongsTo(User::class,'approved_by');
    }

    public function rejection(): MorphOne{
        return $this->morphOne(Rejection::class, 'rejectable');
    }

    public function location()
    {
        return $this->belongsTo(Place::class, 'location_id');
    }

    // Helper method to check if document is location-specific
    public function isLocationSpecific()
    {
        return !is_null($this->location_id);
    }

    
    public function verifiable(){
        return $this->morphTo();
    }
    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\VerificationObserver);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('user',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('user',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('user',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }

    public function rejections(){
        return $this->morphMany(Rejection::class,'rejectable');
    }

    public function rejected(){
        return $this->morphOne(Rejection::class,'rejectable');
    }
    


}
