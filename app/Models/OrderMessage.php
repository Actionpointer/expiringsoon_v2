<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderMessage extends Model
{
    use BroadcastsEvents,HasFactory;
    protected $fillable = ['sender_id','sender_type','receiver_id','receiver_type','read_at','order_id','body','attachment'];


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

    public function broadcastOn($event)
    {
        return [new PrivateChannel('order.'.$this->order_id)];
    }

    public function broadcastAs($event)
    {
        return match ($event) {
            'created' => 'message.created',
            default => null,
        };
    }

    public function broadcastWith($event)
    {
        return match ($event) {
            'created' => ['name' => $this->sender_type == 'App\Models\User' && $this->sender->role->name != 'shopper' ? 'Arbitrator': $this->sender->name,
                            'image'=> $this->sender->image,'body'=> $this->body,'date'=> $this->created_at->format('d M,Y h:i A')],
            default => ['model' => $this],
        };
    }
}

