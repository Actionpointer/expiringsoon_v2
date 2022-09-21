<?php

namespace App\Observers;

use App\Models\Settlement;

class SettlementObserver
{
    /**
     * Handle the Settlement "created" event.
     *
     * @param  \App\Models\Settlement  $settlement
     * @return void
     */
    public function created(Settlement $settlement)
    {
        //
    }

    /**
     * Handle the Settlement "updated" event.
     *
     * @param  \App\Models\Settlement  $settlement
     * @return void
     */
    public function updated(Settlement $settlement)
    {
        //
    }

    /**
     * Handle the Settlement "deleted" event.
     *
     * @param  \App\Models\Settlement  $settlement
     * @return void
     */
    public function deleted(Settlement $settlement)
    {
        //
    }

    /**
     * Handle the Settlement "restored" event.
     *
     * @param  \App\Models\Settlement  $settlement
     * @return void
     */
    public function restored(Settlement $settlement)
    {
        //
    }

    /**
     * Handle the Settlement "force deleted" event.
     *
     * @param  \App\Models\Settlement  $settlement
     * @return void
     */
    public function forceDeleted(Settlement $settlement)
    {
        //
    }
}
