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
        $this->resetProducts($subscription->user);
        $this->resetShops($subscription->user);
        $subscription->user->notify(new SubscriptionStatusNotification($subscription));
    }


    public function deleted(Subscription $subscription)
    {
        if($subscription->end_at){
            Subscription::withTrashed()->where('user_id',$subscription->user_id)->whereNull('end_at')->restore();
        }
        $this->resetProducts($subscription->user);
        $this->resetShops($subscription->user);
    }

    public function restored(Subscription $subscription)
    {
        
    }

    public function forceDeleted(Subscription $subscription)
    {
        //
    }
}
