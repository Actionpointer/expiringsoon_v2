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
            //if coupon was used, reduce coupon
            if($payment->coupon_id && $payment->coupon_value > 0){
                $payment->coupon->available = $payment->coupon->available - 1;
                $payment->coupon->save();
            }
            if($payment->paymentable_type == 'App\Models\Purchase'){
                //create revenue,
                Revenue::create(['payment_id'=> $payment->id ,'currency_code'=> $payment->currency_code,
                    'amount'=> $payment->payable,'description'=> str_replace('App\Models\\','',$payment->paymentable->purchaseable_type)]);
            } 
            else{
                // get commission & create revenue
                
                // create settlement

                // reduce product variant stock or giveaway or sales or bundles, 
                switch($payment->paymentable->orderable_type){
                    case 'App\Models\ProductVariant': 
                        break;
                    case 'App\Models\ProductSale':
                        break;
                    case 'App\Models\ProductGiveaway':
                        break;
                    case 'App\Models\ProductBundle':
                        break;
                }
                Revenue::create(['payment_id'=> $payment->id ,'country_id'=> $payment->user->country_id,'currency_id'=> $payment->currency_id,
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
