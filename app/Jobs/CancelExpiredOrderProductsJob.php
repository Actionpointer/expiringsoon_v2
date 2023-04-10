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

class CancelExpiredOrderProductsJob implements ShouldQueue
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
        $orders = Order::whereDoesntHave('statuses',function($query){
            $query->where('name','delivered')->withTrashed();
        })->whereHas('items',function($pqr){
            $pqr->whereHas('product',function($abc){
                $abc->where('expired_at','<',now());
            });
        })->get();
        foreach($orders  as $order){
            OrderStatus::create(['order_id'=> $order->id,'user_id'=> $order->user_id,'name'=> 'cancelled']);
        }
    }
}
