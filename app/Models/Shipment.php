<?php

namespace App\Models;

use App\Models\Rate;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable = ['address_id','rate_id','order_id','amount','ready_at','delivered_at'];
    protected $dates = ['ready_at','expected_at'];
    public function rate(){
        return $this->belongsTo(Rate::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('rate',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('rate',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('rate',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }
    
}
