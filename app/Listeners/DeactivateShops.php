<?php

namespace App\Listeners;

use App\Events\SubscriptionExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $user = $event->subscription->user;
        $allowed_products = $user->allowedProducts();
        $user_products = $user->products;
        $current_products = $user_products->count();
        // Product::whereIn('id',[$user_products->pluck('id')->toArray()])->take($current_products - $allowed_products)->update(['status'=> false]);
    }
}
