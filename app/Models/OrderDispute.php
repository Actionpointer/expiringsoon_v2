<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDispute extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','arbitrator_id','seller','buyer','remark'];
    
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function arbitrator(){
        return $this->belongsTo(User::class,'arbitrator_id');
    }

    
}
