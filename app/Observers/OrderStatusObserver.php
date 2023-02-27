<?php

namespace App\Observers;

use App\Models\OrderStatus;

class OrderStatusObserver
{
    /**
     * Handle the OrderStatus "created" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function created(OrderStatus $orderStatus)
    {
        OrderStatus::where('order_id',$orderStatus->order_id)->where('name','!=',$orderStatus->name)->delete();
    }

    /**
     * Handle the OrderStatus "updated" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function updated(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Handle the OrderStatus "deleted" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function deleted(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Handle the OrderStatus "restored" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function restored(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Handle the OrderStatus "force deleted" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function forceDeleted(OrderStatus $orderStatus)
    {
        //
    }
}
