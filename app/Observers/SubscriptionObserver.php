<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Notifications\SubscriptionPurchasedNotification;
use App\Notifications\SubscriptionRenewalCancelNotification;
use App\Notifications\SubscriptionRenewalNotification;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function created(Subscription $subscription)
    {
        //
    }

    /**
     * Handle the Subscription "updated" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function updated(Subscription $subscription)
    {
        if($subscription->isDirty('status') && $subscription->status){
            if($subscription->end_at->diffInMonths(now()) < 1){
                //it was renewed
                $subscription->end_at = now()->addMonths($subscription->duration);
                $subscription->save();
                $subscription->user->notify(new SubscriptionRenewalNotification($subscription));
                
            }else{
                $subscription->user->notify(new SubscriptionPurchasedNotification($subscription));
            }
            
        }
        if($subscription->isDirty('auto_renew') && !$subscription->auto_renew){
            $subscription->user->notify(new SubscriptionRenewalCancelNotification($subscription));
        }
    }

    /**
     * Handle the Subscription "deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function deleted(Subscription $subscription)
    {
        //
    }

    /**
     * Handle the Subscription "restored" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function restored(Subscription $subscription)
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function forceDeleted(Subscription $subscription)
    {
        //
    }
}
