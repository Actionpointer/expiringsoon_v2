<?php

namespace App\Observers;

use App\Models\Shop;

class ShopObserver
{
    /**
     * Handle the Shop "created" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function created(Shop $shop)
    {
        if(cache('settings')['auto_approve_shop'])
        $shop->approved = true;
        if($shop->owner()->activeSubscription)
        $shop->status = true;
        $shop->save();
    }

    /**
     * Handle the Shop "updated" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function updated(Shop $shop)
    {
        if($shop->isDirty('state_id') || $shop->isDirty('address') || $shop->isDirty('city_id')){
            if($shop->addressproof){
                $shop->addressproof->status = false;
                $shop->addressproof->reason = 'Shop new address does not match document';
                $shop->addressproof->save();
                $shop->approved = false;
                $shop->save();
            }
            
        }
        if($shop->isDirty('name')){
            if($shop->companydoc){
                $shop->companydoc->status = false;
                $shop->companydoc->reason = 'Shop new name does not match document';
                $shop->companydoc->save();
                $shop->approved = false;
                $shop->save();
            }
            
        }
    }

    public function deleting(Shop $shop)
    {
        $shop->adverts->delete();
        $shop->orders->delete();
        $shop->carts->delete();
        $shop->products->delete();
    }

    public function deleted(Shop $shop)
    {
        //send an email to the owner
    }

    /**
     * Handle the Shop "restored" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function restored(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function forceDeleted(Shop $shop)
    {
        //
    }
}
