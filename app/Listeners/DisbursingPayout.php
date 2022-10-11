<?php

namespace App\Listeners;

use App\Events\DisbursePayout;
use App\Http\Traits\PayoutTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DisbursingPayout implements ShouldQueue
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
     * @param  \App\Events\DisbursePayout  $event
     * @return void
     */
    public function handle(DisbursePayout $event)
    {
        $this->initializePayout($event->payout);
    }
}
