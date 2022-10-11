<?php

namespace App\Listeners;

use App\Events\DeleteShop;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        
        $event->shop->adverts->delete();
        $event->shop->users()->detach();
        $event->shop->orders->delete();
        $event->shop->carts->delete();
        $event->shop->products->delete();
    }
}
