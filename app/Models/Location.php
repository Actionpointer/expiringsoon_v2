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
    protected $fillable = ['ip','country_id','country','continent','state','city','dial'];

    public function country(){
        return $this->belongsTo(Country::class);
    }
    
}
