<?php

namespace App\Listeners;

use App\Models\Like;
use App\Events\OrderPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveFromWishList implements ShouldQueue
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
            $wishlist = Like::where('user_id',$event->order->user_id)->where('product_id',$cart->product_id)->delete();
        }
    }
}
