<?php

namespace App\Listeners;

use App\Events\RetryPayout;
use App\Http\Traits\PayoutTrait;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RetryingPayout implements ShouldQueue
{
    use PayoutTrait;
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
     * @param  \App\Events\RetryPayout  $event
     * @return void
     */
    public function handle(RetryPayout $event)
    {
        $this->retryFlutterWave($event->payout);
    }
}
