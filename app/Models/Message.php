<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id','receiver_id','body','read_at'];
    protected $dates = ['read_at'];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    
}
