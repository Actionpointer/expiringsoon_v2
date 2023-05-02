<?php

namespace App\Models;

use App\Models\Order;
use App\Observers\SettlementObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settlement extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = ['receiver_id','receiver_type','order_id','description','amount','status'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function receiver(){
        return $this->morphTo();
    }
    public function getRouteKeyName(){
        return 'reference';
    }
    public static function boot(){
        parent::boot();
        parent::observe(new SettlementObserver);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('receiver',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('receiver',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('receiver',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }
}
