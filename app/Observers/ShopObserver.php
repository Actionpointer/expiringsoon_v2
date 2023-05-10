<?php

namespace App\Observers;

use App\Models\Shop;
use App\Events\DeleteShop;
use App\Http\Traits\OptimizationTrait;
use App\Notifications\ShopStatusNotification;


class ShopObserver
{
    use OptimizationTrait;
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
        $shop->status = $shop->user->max_shops >= $shop->user->total_shops ? true:false;
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
                $shop->addressproof->reason = 'Shop new address does not match address proof document';
                $shop->addressproof->save();
                $shop->approved = false;
                $shop->save();
                $shop->user->notify(new ShopStatusNotification($shop));
            }
            
        }
        if($shop->isDirty('name')){
            if($shop->companydoc){
                $shop->companydoc->status = false;
                $shop->companydoc->reason = 'Shop new name does not match kyc document';
                $shop->companydoc->save();
                $shop->approved = false;
                $shop->save();
                $shop->user->notify(new ShopStatusNotification($shop));
            }
            
        }
    }

    public function deleting(Shop $shop)
    {
        event(new DeleteShop($shop));
    }

    public function deleted(Shop $shop){
        $this->resetProducts($shop->user);
        $this->resetShops($shop->user);
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
