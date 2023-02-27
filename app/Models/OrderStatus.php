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
    protected $fillable = ['name','order_id','user_id'];
    
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
}
