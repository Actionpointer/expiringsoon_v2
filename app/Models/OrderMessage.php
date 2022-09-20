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
    protected $fillable = ['user_id','order_id','shop_id','body','sender','receiver','read_at'];
    protected $dates = ['read_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
