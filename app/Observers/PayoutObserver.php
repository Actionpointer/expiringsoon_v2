<?php

namespace App\Observers;

use App\Models\Payout;

class PayoutObserver
{
    /**
     * Handle the Payout "created" event.
     *
     * @param  \App\Models\Payout  $payout
     * @return void
     */
    public function created(Payout $payout)
    {
        //
    }

    /**
     * Handle the Payout "updated" event.
     *
     * @param  \App\Models\Payout  $payout
     * @return void
     */
    public function updated(Payout $payout)
    {
        //send email
    }

    /**
     * Handle the Payout "deleted" event.
     *
     * @param  \App\Models\Payout  $payout
     * @return void
     */
    public function deleted(Payout $payout)
    {
        //
    }

    /**
     * Handle the Payout "restored" event.
     *
     * @param  \App\Models\Payout  $payout
     * @return void
     */
    public function restored(Payout $payout)
    {
        //
    }

    /**
     * Handle the Payout "force deleted" event.
     *
     * @param  \App\Models\Payout  $payout
     * @return void
     */
    public function forceDeleted(Payout $payout)
    {
        //
    }
}
