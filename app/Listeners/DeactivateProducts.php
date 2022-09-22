<?php

namespace App\Listeners;

use App\Models\Product;
use App\Events\SubscriptionExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeactivateProducts implements ShouldQueue
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
        // $event->subscription
        $user = $event->subscription->user;
        $allowed_products = $user->allowedProducts();
        $user_products = $user->products;
        $current_products = $user_products->count();
        Product::whereIn('id',[$user_products->pluck('id')->toArray()])->take($current_products - $allowed_products)->update(['status'=> false]);
        
    }
}
