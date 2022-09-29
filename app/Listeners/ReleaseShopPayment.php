<?php

namespace App\Listeners;

use App\Models\Setting;
use App\Events\ShopPaymentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReleaseShopPayment implements ShouldQueue
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
     * @param  ShopPaymentEvent  $event
     * @return void
     */
    public function handle(ShopPaymentEvent $event)
    {
        // Access the order using $event->order...
        $settings = Setting::all();
        $seller_percentage = $settings->where('name','seller_percentage')->first()->value;
        $event->order->shop->wallet = $seller_percentage * $event->order->subtotal / 100;
        $event->order->shop->save();
        
    }
}
