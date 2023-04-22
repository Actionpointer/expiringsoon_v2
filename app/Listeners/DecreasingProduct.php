<?php

namespace App\Listeners;

use App\Events\DecreaseProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecreasingProduct
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
    public function handle(DecreaseProduct $event)
    {
        foreach($event->order->items as $cart){
            $cart->product->stock -= $cart->quantity;
            $cart->product->save();
        }

    }
}
