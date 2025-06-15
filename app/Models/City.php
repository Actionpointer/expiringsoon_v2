<?php

namespace App\Models;

use App\Models\Store;
use App\Models\User;
use App\Models\State;
use App\Models\Address;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name','state_id','delivery'];
    protected $connection = 'sqlite_cities';
    protected $table = 'cities'; // adjust table name if different

    public function state(){
        return $this->belongsTo(State::class);
    }

    // public function country(){
    //     return $this->belongsTo(State::class)->belongsTo(Country::class);
    // }

    public function stores(){
        return $this->hasMany(Store::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    
    public function addresses(){
        return $this->hasMany(Address::class);
    }
    public function rates(){
        return $this->hasMany(Rate::class);
    }

}
