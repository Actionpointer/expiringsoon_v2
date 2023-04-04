<?php

namespace App\Models;

use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory;
    protected $fillable = ['shop_id','country_id','origin_id','destination_id','hours','amount'];

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function origin(){
        return $this->belongsTo(State::class,'origin_id');
    }
    public function destination(){
        return $this->belongsTo(State::class,'destination_id');
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->where('country_id',$value);
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->where('country_id',auth()->user()->country_id);
        }else{
            return $query->where('country_id',session('locale')['country_id']);
        }  
    }
}
