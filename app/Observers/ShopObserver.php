<?php

namespace App\Observers;

use App\Models\Shop;
use App\Models\Rejection;
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
        if($shop->published){
            Shop::where('id',$shop->id)->update([
                'approved'=> cache('settings')['auto_approve_shop'],'show'=> $shop->user->max_shops >= $shop->user->total_shops ? true:false,'published' => $shop->publishable]);
        }
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
                Rejection::create(['rejectable_id'=> $shop->addressproof->id,'rejectable_type'=> 'App\Models\Kyc','reason'=> 'Shop new address does not match address proof document']);
                $shop->approved = false;
                $shop->save();
            }
            
        }
        if($shop->isDirty('name')){
            if($shop->certificate){
                $shop->certificate->status = false;
                $shop->certificate->save();
                $shop->approved = false;
                $shop->save(); 
            }
            if($shop->companydocs->isNotEmpty()){
                foreach($shop->companydocs as $companydoc){
                    $companydoc->status = false;
                    $companydoc->save();
                    $shop->approved = false;
                    $shop->save(); 
                }   
            }
            
        }
        if($shop->wasChanged('published') && $shop->published){
            Shop::where('id',$shop->id)->update([
                'approved'=> cache('settings')['auto_approve_shop'],'show'=> $shop->user->max_shops >= $shop->user->total_shops ? true:false,'published' => $shop->publishable]);
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
