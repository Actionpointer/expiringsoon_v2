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

class OrderDeliveredToCompletedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //send message to vendor & user
        $period = cache('settings')['order_delivered_to_acceptance_period'];

        $orders = Order::whereHas('statuses',function($query) use($period){
                $query->where('name','delivered')->where('created_at','<',now()->subHours($period));
            })->get();

        foreach($orders as $order){
            OrderStatus::create(['order_id' => $order->id, 'user_id'=> $order->user_id, 'name' => 'completed']);
        }
    }
}
