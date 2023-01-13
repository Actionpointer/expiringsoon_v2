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
        $current_products = $user->products->count();
        Product::whereIn('id',[$user->products->pluck('id')->toArray()])->take($current_products - $allowed_products)->update(['status'=> false]);
        
    }
}
