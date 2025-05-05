<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\DeleteStore;
use App\Http\Traits\OptimizationTrait;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletingStore implements ShouldQueue
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
     * @param  \App\Events\DeleteStore  $event
     * @return void
     */
    public function handle(DeleteStore $event)
    {
        //delete all adverts
        $event->store->adverts->delete();
        //delete all carts
        $event->store->carts->delete();
        //delete all wishlists
        $event->store->likes->delete();
        //delete all products
        $event->store->products->delete();
        //delete all orders
        $event->store->orders->delete();
        //delete all staff
        User::where('store_id',$event->store->id)->delete();
    }
}
