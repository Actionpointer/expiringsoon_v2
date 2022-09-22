<?php

namespace App\Jobs;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\ShopOrderNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ConvertDeliveredToCompletedJob implements ShouldQueue
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
        $period = cache('settings')['order_rejection_period'];
        $orders = Order::where('status','delivered')->where('delivered_at','>',now()->subHours($period))->get();
        foreach($orders as $order){
            $order->status = 'completed';
            $order->save();
        }
    }
}
