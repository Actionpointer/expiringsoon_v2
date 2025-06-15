<?php

namespace App\Observers;

use App\Models\Adset;
use App\Notifications\StoreNotification\AdsetStatusNotification;


class AdsetObserver
{
    /**
     * Handle the Adset "created" event.
     *
     * @param  \App\Models\Adset  $adset
     * @return void
     */
    public function created(Adset $adset)
    {
        //
    }

    /**
     * Handle the Adset "updated" event.
     *
     * @param  \App\Models\Adset  $adset
     * @return void
     */
    public function updated(Adset $adset)
    {
        if($adset->isDirty('status') && $adset->status){
            if($adset->start_at->diffInHours($adset->updated_at) > 24){
                //it was renewed
                $adset->end_at = now()->addMonths($adset->duration);
                $adset->save();
                $adset->user->notify(new AdsetStatusNotification($adset));
            }
            
        }
        if($adset->isDirty('auto_renew') && !$adset->auto_renew){
            $adset->user->notify(new AdsetStatusNotification($adset));
        }
    }

    /**
     * Handle the Adset "deleted" event.
     *
     * @param  \App\Models\Adset  $adset
     * @return void
     */
    public function deleted(Adset $adset)
    {
        //
    }

    /**
     * Handle the Adset "restored" event.
     *
     * @param  \App\Models\Adset  $adset
     * @return void
     */
    public function restored(Adset $adset)
    {
        //
    }

    /**
     * Handle the Adset "force deleted" event.
     *
     * @param  \App\Models\Adset  $adset
     * @return void
     */
    public function forceDeleted(Adset $adset)
    {
        //
    }
}
