<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Feature;
use App\Models\PaymentItem;
use App\Models\Subscription;

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
            $order = Order::find($paymentItem->paymentable_id);
            $order->status = 'processing';
            $order->save();
        }
        if($paymentItem->paymentable_type == 'App\Models\Feature'){
            $feature = Feature::find($paymentItem->paymentable_id);
            $feature->status = true;
            $feature->save();
        }
        if($paymentItem->paymentable_type == 'App\Models\Subscription'){
            $subscription = Subscription::find($paymentItem->paymentable_id);
            $subscription->status = true;
            $subscription->save();
        }
        
    }

    public function updated(PaymentItem $paymentItem)
    {
        if($paymentItem->paymentable_type == 'App\Models\Order'){
            $order = Order::find($paymentItem->paymentable_id);
            $order->status = 'processing';
            $order->save();
        }
        if($paymentItem->paymentable_type == 'App\Models\Feature'){
            $feature = Feature::find($paymentItem->paymentable_id);
            $feature->status = true;
            $feature->save();
        }
        if($paymentItem->paymentable_type == 'App\Models\Subscription'){
            $subscription = Subscription::find($paymentItem->paymentable_id);
            $subscription->status = true;
            $subscription->save();
        }
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
