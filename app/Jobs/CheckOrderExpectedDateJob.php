<?php

namespace App\Jobs;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\ShopOrderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

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
        $orders = Order::where('status','processing')->where('expected_at','<',now())->whereBetween('expected_at',[now(),now()->addDay()])->get();
        $shops = Shop::whereIn('id',$orders->unique('shop_id')->pluck('shop_id')->toArray())->get();
        $users = User::whereIn('id',$orders->unique('user_id')->pluck('user_id')->toArray())->get();
        Notification::send($shops,new ShopOrderNotification);
        Notification::send($users,new OrderStatusNotification);
    }
}
