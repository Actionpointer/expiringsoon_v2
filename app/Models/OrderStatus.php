<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Observers\OrderStatusObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','description','order_id','user_id'];
    
    public static function boot()
    {
        parent::boot();
        parent::observe(new OrderStatusObserver);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('order.shop',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('order.shop',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('order.shop',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }
}
