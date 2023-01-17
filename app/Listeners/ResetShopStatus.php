<?php

namespace App\Listeners;

use App\Models\Shop;
use App\Events\UserSubscribed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetShopStatus implements ShouldQueue
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
     * @param  \App\Events\UserSubscribed  $event
     * @return void
     */
    public function handle(UserSubscribed $event)
    {
        $user = $event->user;
        $allowed_shops = $user->allowedShops();
        $user_shops = $user->shops;
        $current_shops = $user_shops->count();
        Shop::whereIn('id',$user_shops->pluck('id')->toArray())->take($current_shops - $allowed_shops)->update(['status'=> false]);
    }
}
