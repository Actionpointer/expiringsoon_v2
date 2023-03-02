<?php

namespace App\Models;

use App\Models\Order;
use App\Observers\SettlementObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settlement extends Model
{
    use HasFactory;
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
}
