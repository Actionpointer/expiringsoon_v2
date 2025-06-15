<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Http\Traits\OptimizationTrait;
use App\Notifications\StoreNotification\SubscriptionStatusNotification;


class SubscriptionObserver
{
    use OptimizationTrait;
    
    public function created(Subscription $subscription)
    {
        //
    }

    public function updated(Subscription $subscription)
    {
        //send only if subscription was auto-renewed
        //$subscription->user->notify(new SubscriptionStatusNotification($subscription));
    }


    public function deleted(Subscription $subscription)
    {
        
    }

    public function restored(Subscription $subscription)
    {
        
    }

    public function forceDeleted(Subscription $subscription)
    {
        //
    }
}
