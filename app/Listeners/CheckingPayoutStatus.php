<?php

namespace App\Listeners;

use App\Http\Traits\PayoutTrait;
use App\Events\CheckPayoutStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckingPayoutStatus implements ShouldQueue
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
     * @param  \App\Events\CheckPayoutStatus  $event
     * @return void
     */
    public function handle(CheckPayoutStatus $event)
    {
        $this->fetchFlutterWave($event->payout);
    }
}
