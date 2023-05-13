<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class OrderProcessingToCancelledJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct()
    {
        //
    }
    
    public function handle()
    {
        $period = cache('settings')['order_processing_to_auto_cancel_period'];

        $orders = Order::whereHas('statuses',function($query) use($period){
                $query->where('name','processing')->where('created_at','<',now()->subHours($period));
            })->get();
        foreach($orders as $order){
            OrderStatus::create(['order_id' => $order->id, 'user_id'=> $order->user_id, 'name' => 'cancelled']);
        }
    }
}
