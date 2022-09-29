<?php

namespace App\Listeners;

use App\Models\Advert;
use App\Events\FeatureExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeactivateAdverts implements ShouldQueue
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
     * @param  \App\Events\FeatureExpired  $event
     * @return void
     */
    public function handle(FeatureExpired $event)
    {
        Advert::where('feature_id',$event->feature)->take($current_products - $allowed_products)->update(['status'=> false]);
    }
}
