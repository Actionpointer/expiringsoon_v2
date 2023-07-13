<?php

namespace App\Observers;

use App\Models\Adset;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Revenue;
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
            if($item = $payment->items->where('paymentable_type','!=','App\Models\Order')->first()){
                Revenue::create(['country_id'=> $payment->user->country_id,'currency_id'=> $payment->currency_id,
                'amount'=> $payment->payable,'description'=> str_replace('App\Models\\','',$item->paymentable_type)]);
            }
            
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
