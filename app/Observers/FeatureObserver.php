<?php

namespace App\Observers;

use App\Models\Feature;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FollowersFeaturedProductNotification;

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
        $users = $feature->product->shop->followers;
        Notification::send($users,new FollowersFeaturedProductNotification($feature->product));
    }

    /**
     * Handle the Feature "updated" event.
     *
     * @param  \App\Models\Feature  $feature
     * @return void
     */
    public function updated(Feature $feature)
    {
        //
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
