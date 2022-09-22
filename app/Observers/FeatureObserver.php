<?php

namespace App\Observers;

use App\Models\Feature;
use App\Notifications\FeatureRenewalNotification;
use App\Notifications\FeaturePurchasedNotification;
use App\Notifications\FeatureRenewalCancelNotification;

class FeatureObserver
{
    /**
     * Handle the Feature "created" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function created(Feature $feature)
    {
        //
    }

    /**
     * Handle the Feature "updated" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function updated(Feature $feature)
    {
        if($feature->isDirty('status') && $feature->status){
            if($feature->end_at->diffInHours(now()) < 5){
                //it was renewed
                $feature->end_at = now()->addMonths($feature->duration);
                $feature->save();
                $feature->user->notify(new FeatureRenewalNotification($feature));
            }else{
                $feature->user->notify(new FeaturePurchasedNotification($feature));
            }
            
        }
        if($feature->isDirty('auto_renew') && !$feature->auto_renew){
            $feature->user->notify(new FeatureRenewalCancelNotification($feature));
        }
    }

    /**
     * Handle the Feature "deleted" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function deleted(Feature $feature)
    {
        //
    }

    /**
     * Handle the Feature "restored" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function restored(Feature $feature)
    {
        //
    }

    /**
     * Handle the Feature "force deleted" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function forceDeleted(Feature $feature)
    {
        //
    }
}
