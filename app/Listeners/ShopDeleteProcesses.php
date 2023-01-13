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
        
        $event->shop->adverts->delete();
        User::destroy($event->shop->staff->pluck('id')->toArray());
        $event->shop->orders->delete();
        $event->shop->carts->delete();
        $event->shop->products->delete();
    }
}
