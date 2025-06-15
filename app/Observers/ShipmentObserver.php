<?php

namespace App\Observers;

use App\Models\Shipment;
use App\Models\OrderStatus;
use App\Notifications\StoreNotifications\OrderStatusVendorNotification;
use App\Notifications\UserNotificationsOrderStatusCustomerNotification;

class ShipmentObserver
{
    /**
     * Handle the Shipment "created" event.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return void
     */
    public function created(Shipment $shipment)
    {
        //
    }

    
    public function updated(Shipment $shipment)
    {
        if( $shipment->isDirty('shipped_at') && $shipment->shipped_at){
            OrderStatus::create(['order_id'=> $shipment->order_id,'user_id'=> $shipment->order->user_id,'name'=> 'shipped']);
        }
        if( $shipment->isDirty('delivered_at') && $shipment->delivered_at ){
            OrderStatus::create(['order_id'=> $shipment->order_id,'user_id'=> $shipment->order->user_id,'name'=> 'delivered']);  
        }

    }

    /**
     * Handle the Shipment "deleted" event.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return void
     */
    public function deleted(Shipment $shipment)
    {
        //
    }

    /**
     * Handle the Shipment "restored" event.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return void
     */
    public function restored(Shipment $shipment)
    {
        //
    }

    /**
     * Handle the Shipment "force deleted" event.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return void
     */
    public function forceDeleted(Shipment $shipment)
    {
        //
    }
}
