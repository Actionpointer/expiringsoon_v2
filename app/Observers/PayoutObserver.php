<?php

namespace App\Observers;

use App\Models\Payout;
use App\Events\DisbursePayout;

class PayoutObserver
{
    /**
     * Handle the Payout "created" event.
     *
     * @param  \App\Models\Payout  $payout
     * @return void
     */
    public function created(Payout $payout){
        if($payout->status == "pending"){
            // send an email to admin
        }
    }

    public function updated(Payout $payout){
        if($payout->isDirty('status') && $payout->status == "processing"){
            event(new DisbursePayout($payout));
            
        }
        
        //send mail to user based on the status

    }

}
