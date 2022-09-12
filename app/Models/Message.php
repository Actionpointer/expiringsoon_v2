<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','order_id','receiver_id','body','is_read'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
