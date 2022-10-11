<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Settlement;
use App\Events\OrderPurchased;
use App\Notifications\ShopOrderNotification;
use App\Notifications\OrderStatusNotification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        if($order->isDirty('status') && $order->status == 'processing'){
            $delivery = $order->deliveryByVendor() ? $order->deliveryfee : 0;
            $settlement = Settlement::create(['receiver_id'=> $order->shop_id,'receiver_type'=> 'App\Models\Shop','order_id'=> $order->id,'amount'=> $order->earning() + $delivery,'reference'=> uniqid()]);
            event(new OrderPurchased($order));
            $order->shop->notify(new ShopOrderNotification($order,'processing'));
        }
        if($order->isDirty('status') && $order->status == 'shipped'){
            $order->user->notify(new OrderStatusNotification($order,'shipped'));
        }
        if($order->isDirty('status') && $order->status == 'delivered'){
            $order->user->notify(new OrderStatusNotification($order,'delivered'));
        }
        if($order->isDirty('status') && $order->status == 'completed'){
            $order->shop->wallet += $order->settlement->amount;
            $order->shop->save();
            $order->settlement->status = true;
            $order->settlement->save();
            $order->user->notify(new OrderStatusNotification($order,'completed'));
        }
        
    }

    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
