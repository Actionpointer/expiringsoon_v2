<?php

namespace App\Listeners;

use App\Events\OrderPurchased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecreaseProduct implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderPurchased  $event
     * @return void
     */
    public function handle(OrderPurchased $event)
    {
        foreach($event->order->items as $cart){
            $cart->product->stock -= $cart->quantity;
            $cart->product->save();
        }

    }
}
