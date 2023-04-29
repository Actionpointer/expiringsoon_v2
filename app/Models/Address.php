<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','state_id','city_id','street','contact_phone','contact_name','main'];
    
    public function getLocationAttribute(){
        return $this->street.', '.$this->city->name.', '.$this->state->name;
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function city(){
        return $this->belongsTo(City::class)->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
