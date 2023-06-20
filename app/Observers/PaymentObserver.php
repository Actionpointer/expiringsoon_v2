<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Adset;
use App\Models\Payment;
use App\Models\Subscription;

class PaymentObserver
{
    
    public function created(Payment $payment)
    {
        //
    }

    public function updated(Payment $payment)
    {
        if($payment->isDirty('status') && $payment->status == 'success'){
            $items = $payment->items->where('paymentable_type','!=','')
            
        }
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
