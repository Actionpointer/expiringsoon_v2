<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Notifications\SubscriptionStatusNotification;


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
            // if($subscription->created_at->diffInMonths(now()) > 1){
            if($subscription->start_at->diffInHours($subscription->updated_at) > 24){
                //it was renewed
                $subscription->user->notify(new SubscriptionStatusNotification($subscription));
                
            }
            
        }
        if($subscription->isDirty('auto_renew') && !$subscription->auto_renew){
            $subscription->user->notify(new SubscriptionStatusNotification($subscription));
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
