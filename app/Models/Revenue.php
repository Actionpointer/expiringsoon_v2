<?php

namespace App\Models;

use App\Models\Country;
use App\Models\Payment;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Revenue extends Model
{
    use HasFactory;
    protected $fillable = ['payment_id','currency_code','amount','description'];

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

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
