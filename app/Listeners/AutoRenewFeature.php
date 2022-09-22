<?php

namespace App\Listeners;

use App\Events\RenewFeature;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AutoRenewFeature
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
     * @param  \App\Events\RenewFeature  $event
     * @return void
     */
    public function handle(RenewFeature $event)
    {
        //handle the payment of the feature
    }
}
