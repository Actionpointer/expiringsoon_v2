<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\DeleteShop;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShopDeleteProcesses implements ShouldQueue
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
     * @param  \App\Events\DeleteShop  $event
     * @return void
     */
    public function handle(DeleteShop $event)
    {
        //orders
        //staff
        //carts
        //products
        //advert containing shop
        //reset remaining shop status
        //reset remaining prpducts status
        $user = $event->user;
        $user->adverts->delete();
        User::where('shop_id',$event->user->shops->pluck('id')->toArray())->delete();
        $event->shop->orders->delete();
        $event->shop->carts->delete();
        $event->shop->products->delete();
    }
}
