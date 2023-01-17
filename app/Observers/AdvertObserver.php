<?php

namespace App\Observers;

use App\Models\Advert;

class AdvertObserver
{
    
    public function created(Advert $advert)
    {
        if(($advert->advertable_type =='App\Models\Shop' && cache('settings')['auto_approve_shop_advert']) || ($advert->advertable_type =='App\Models\Product' && cache('settings')['auto_approve_product_advert']))
            $advert->approved = true;
        $advert->save();
    }

    /**
     * Handle the Advert "updated" event.
     *
     * @param  \App\Models\Advert  $advert
     * @return void
     */
    public function updated(Advert $advert)
    {
        //
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
