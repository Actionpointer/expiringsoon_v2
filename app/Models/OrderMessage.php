<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderMessage extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id','order_id','sender_type','body','read_at'];
    protected $dates = ['read_at'];

    public function user(){
        return $this->belongsTo(User::class,'sender_id')->where('sender_type','App\Models\User');
    }
    public function shop(){
        return $this->belongsTo(Shop::class,'sender_id')->where('sender_type','App\Models\Shop');
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function sender(){
        return $this->morphTo();
    }
}
