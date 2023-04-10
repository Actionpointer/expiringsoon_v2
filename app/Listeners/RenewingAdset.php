<?php

namespace App\Listeners;

use App\Events\RenewAdset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RenewingAdset
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
     * @param  \App\Events\RenewAdset  $event
     * @return void
     */
    public function handle(RenewAdset $event)
    {
        //
    }
}
