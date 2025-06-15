<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public function scopeWithin($query){
        $country = session('locale')['country_id'];
        return $query->where('country_id',$country);
    }
}
