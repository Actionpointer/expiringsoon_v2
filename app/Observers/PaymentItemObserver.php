<?php

namespace App\Observers;

use App\Models\PaymentItem;

class PaymentItemObserver
{
    /**
     * Handle the PaymentItem "created" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function created(PaymentItem $paymentItem)
    {
        if($paymentItem->paymentable_type == 'App\Models\Order'){
            $paymentItem->paymentable->status == 'processing';
            $paymentItem->paymentable->save();

           
        }
    }

    public function updated(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Handle the PaymentItem "deleted" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function deleted(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Handle the PaymentItem "restored" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function restored(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Handle the PaymentItem "force deleted" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function forceDeleted(PaymentItem $paymentItem)
    {
        //
    }
}
