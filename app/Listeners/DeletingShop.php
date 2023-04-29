<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\DeleteShop;
use App\Http\Traits\OptimizationTrait;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletingShop implements ShouldQueue
{
    use OptimizationTrait;
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
     * @param  \App\Events\DeleteShop  $event
     * @return void
     */
    public function handle(DeleteShop $event)
    {
        //delete all adverts
        $event->shop->adverts->delete();
        //delete all carts
        $event->shop->carts->delete();
        //delete all wishlists
        $event->shop->likes->delete();
        //delete all products
        $event->shop->products->delete();
        //delete all orders
        $event->shop->orders->delete();
        //delete all staff
        User::where('shop_id',$event->shop->id)->delete();
    }
}
