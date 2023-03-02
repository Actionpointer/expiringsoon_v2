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
        //send an email to vendor ? should you?
    }

    public function updated(Settlement $settlement)
    {
        //if paid, send an email to vendor
        if($settlement->isDirty('status') && $settlement->status){
            /*
                send email to customer
           */
            
        }
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

    
    public function forceDeleted(Settlement $settlement)
    {
        //
    }
}
