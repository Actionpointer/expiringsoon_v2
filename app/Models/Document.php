<?php

namespace App\Models;

use App\Models\User;
use App\Models\Profile;
use App\Models\Rejection;
use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['profile_id','file','type','approved_at','approved_by'];
    protected $casts = ['approved_at'=> 'datetime'];

    public function profile(){
        return $this->belongsTo(Profile::class);
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

}
