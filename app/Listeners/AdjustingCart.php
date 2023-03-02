<?php

namespace App\Listeners;

use App\Events\AdjustCart;
use App\Http\Traits\CartTrait;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdjustingCart
{
    use CartTrait;
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
     * @param  \App\Events\AdjustCart  $event
     * @return void
     */
    public function handle(AdjustCart $event)
    {
        foreach($event->order->items as $order_item){
            $product = $order_item->product;
            $cart = $this->removeFromCartSession($product);
            $this->removeFromCartDb($product);
        }
    }
}
