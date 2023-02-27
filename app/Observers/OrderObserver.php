<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;
use App\Events\OrderPurchased;
use App\Notifications\OrderShipmentNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStatusVendorNotification;
use App\Notifications\OrderStatusCustomerNotification;

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
            event(new OrderPurchased($order));
            $order->shop->notify(new OrderStatusVendorNotification($order));
        }
        if($order->isDirty('status') && $order->status == 'ready'){
            if($order->deliverer == "admin"){
                Notification::send(User::where('role','admin')->get(),new OrderShipmentNotification($order));
            }else{
                $order->user->notify(new OrderStatusCustomerNotification($order));
            }
        }
        if($order->isDirty('status') && $order->status == 'shipped'){
            $order->user->notify(new OrderStatusCustomerNotification($order));
        }
        if($order->isDirty('status') && $order->status == 'delivered'){
            $order->user->notify(new OrderStatusCustomerNotification($order));
        }
        if($order->isDirty('status') && $order->status == 'completed'){
            $order->shop->wallet += $order->settlement->amount;
            $order->shop->save();
            $order->settlement->status = true;
            $order->settlement->save();
            $order->user->notify(new OrderStatusVendorNotification($order));
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
