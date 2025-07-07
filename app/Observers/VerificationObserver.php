<?php

namespace App\Observers;

use App\Models\Verification;
use App\Notifications\VerificationRejectionNotification;

class VerificationObserver
{
    /**
     * Handle the Verification "created" event.
     *
     * @param  \App\Models\Verification  $verification
     * @return void
     */
    public function created(Verification $verification)
    {
        //
    }

    /**
     * Handle the Verification "updated" event.
     *
     * @param  \App\Models\Verification  $verification
     * @return void
     */
    public function updated(Verification $verification)
    {
        if($verification->isDirty('document')){
            $verification->status = 0;
            $verification->save();
        }
        
    }

    /**
     * Handle the Verification "deleted" event.
     *
     * @param  \App\Models\Verification  $verification
     * @return void
     */
    public function deleted(Verification $verification)
    {
        //
    }

    /**
     * Handle the Verification "restored" event.
     *
     * @param  \App\Models\Verification  $verification
     * @return void
     */
    public function restored(Verification $verification)
    {
        //
    }

    /**
     * Handle the Verification "force deleted" event.
     *
     * @param  \App\Models\Verification  $verification
     * @return void
     */
    public function forceDeleted(Verification $verification)
    {
        //
    }
}
