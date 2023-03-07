<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['ipaddress','user_id','country_id','state_id','city_id'];

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
