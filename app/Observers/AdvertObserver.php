<?php

namespace App\Observers;

use App\Models\Advert;
use App\Notifications\AdvertStatusNotification;

class AdvertObserver
{
    /**
     * Handle the Advert "created" event.
     *
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function created(Advert $advert)
    {
        //
    }

    /**
     * Handle the Advert "updated" event.
     *
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function updated(Advert $advert)
    {
        if($advert->isDirty('rejection_reason')){
            $advert->adset->user->notify(new AdvertStatusNotification($advert));
        }
    }

    /**
     * Handle the Advert "deleted" event.
     *
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function deleted(Advert $advert)
    {
        //
    }

    /**
     * Handle the Advert "restored" event.
     *
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function restored(Advert $advert)
    {
        //
    }

    /**
     * Handle the Advert "force deleted" event.
     *
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function forceDeleted(Advert $advert)
    {
        //
    }
}
