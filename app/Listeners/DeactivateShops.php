<?php

namespace App\Listeners;

use App\Models\Shop;
use App\Models\Product;
use App\Events\SubscriptionExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeactivateShops implements ShouldQueue
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
     * @param  \App\Events\SubscriptionExpired  $event
     * @return void
     */
    public function handle(SubscriptionExpired $event)
    {
        
    }
}
