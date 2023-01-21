<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\OrderStatusVendorNotification;

class CheckOrderExpectedDateJob implements ShouldQueue
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
        $orders = Order::where('status','processing')->where('expected_at','>',now())->where('expected_at','<=',now()->addDay())->get();
        foreach($orders as $order){
            $order->shop->notify(new OrderStatusVendorNotification($order,'late'));
        }
    }
}
