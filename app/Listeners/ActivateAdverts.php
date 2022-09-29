<?php

namespace App\Listeners;

use App\Events\UserFeatured;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateAdverts implements ShouldQueue
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
     * @param  \App\Events\UserFeatured  $event
     * @return void
     */
    public function handle(UserFeatured $event)
    {
        //
    }
}
