<?php

namespace App\Observers;

use App\Models\Rejection;
use App\Notifications\ShopStatusNotification;
use App\Notifications\AdvertStatusNotification;
use App\Notifications\KycRejectionNotification;
use App\Notifications\ProductStatusNotification;
use App\Notifications\UserStatusNotification;

class RejectionObserver
{
    /**
     * Handle the Rejection "created" event.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return void
     */
    public function created(Rejection $rejection)
    {
        switch($rejection->rejectable_type){
            case 'App\Models\Product':
                    $rejection->rejectable->shop->notify(new ProductStatusNotification($rejection->rejectable));
                break;
            case 'App\Models\Shop':
                $rejection->rejectable->notify(new ShopStatusNotification($rejection->rejectable));
            break;
            case 'App\Models\Advert':
                $rejection->rejectable->adset->user->notify(new AdvertStatusNotification($rejection->rejectable));
            break;
            case 'App\Models\Kyc':
                $rejection->rejectable->user->notify(new KycRejectionNotification($rejection->rejectable));
            break;
            case 'App\Models\User':
                $rejection->rejectable->notify(new UserStatusNotification());
            break;
        }
        
    }

    /**
     * Handle the Rejection "updated" event.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return void
     */
    public function updated(Rejection $rejection)
    {
        //
    }

    /**
     * Handle the Rejection "deleted" event.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return void
     */
    public function deleted(Rejection $rejection)
    {
        //
    }

    /**
     * Handle the Rejection "restored" event.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return void
     */
    public function restored(Rejection $rejection)
    {
        //
    }

    /**
     * Handle the Rejection "force deleted" event.
     *
     * @param  \App\Models\Rejection  $rejection
     * @return void
     */
    public function forceDeleted(Rejection $rejection)
    {
        //
    }
}
