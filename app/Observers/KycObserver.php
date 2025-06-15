<?php

namespace App\Observers;

use App\Models\Kyc;
use App\Notifications\KycRejectionNotification;

class KycObserver
{
    /**
     * Handle the Kyc "created" event.
     *
     * @param  \App\Models\Kyc  $kyc
     * @return void
     */
    public function created(Kyc $kyc)
    {
        //
    }

    /**
     * Handle the Kyc "updated" event.
     *
     * @param  \App\Models\Kyc  $kyc
     * @return void
     */
    public function updated(Kyc $kyc)
    {
        if($kyc->isDirty('document')){
            $kyc->status = 0;
            $kyc->save();
        }
        
    }

    /**
     * Handle the Kyc "deleted" event.
     *
     * @param  \App\Models\Kyc  $kyc
     * @return void
     */
    public function deleted(Kyc $kyc)
    {
        //
    }

    /**
     * Handle the Kyc "restored" event.
     *
     * @param  \App\Models\Kyc  $kyc
     * @return void
     */
    public function restored(Kyc $kyc)
    {
        //
    }

    /**
     * Handle the Kyc "force deleted" event.
     *
     * @param  \App\Models\Kyc  $kyc
     * @return void
     */
    public function forceDeleted(Kyc $kyc)
    {
        //
    }
}
