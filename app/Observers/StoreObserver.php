<?php

namespace App\Observers;

use App\Models\Store;
use App\Models\Rejection;
use App\Events\DeleteStore;
use App\Http\Traits\OptimizationTrait;



class StoreObserver
{
    use OptimizationTrait;
    /**
     * Handle the Store "created" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function created(Store $store)
    {
        if($store->published){
            Store::where('id',$store->id)->update([
                'approved'=> config('settings.auto_approve_store'),
            ]);
            $this->createWallet($store);

        }
    }

    
    public function updated(Store $store)
    {
        if($store->isDirty('state_id') || $store->isDirty('address') || $store->isDirty('city_id')){
            if($store->addressproof){  
                Rejection::create(['rejectable_id'=> $store->addressproof->id,'rejectable_type'=> 'App\Models\Kyc','reason'=> 'Store new address does not match address proof document']);
                $store->approved = false;
                $store->save();
            }
            
        }
        if($store->isDirty('name')){
            if($store->certificate){
                $store->certificate->status = false;
                $store->certificate->save();
                $store->approved = false;
                $store->save(); 
            }
            if($store->companydocs->isNotEmpty()){
                foreach($store->companydocs as $companydoc){
                    $companydoc->status = false;
                    $companydoc->save();
                    $store->approved = false;
                    $store->save(); 
                }   
            }
            
        }
        if($store->wasChanged('published') && $store->published){
            Store::where('id',$store->id)->update([
                'approved'=> cache('settings')['auto_approve_store'],'show'=> $store->user->max_stores >= $store->user->total_stores ? true:false,'published' => $store->publishable]);
        }
        
    }

    public function createWallet(Store $store){
        $store->wallet()->create([
            'balance' => 0,
            'currency_code' => $store->country->currency_code,
            'status' => 'active',
        ]);
    }

    public function deleting(Store $store){
        event(new DeleteStore($store));
    }

    public function deleted(Store $store){
        $this->resetProducts($store->user);
        $this->resetStores($store->user);
    }

    /**
     * Handle the Store "restored" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function restored(Store $store)
    {
        //
    }

    /**
     * Handle the Store "force deleted" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function forceDeleted(Store $store)
    {
        //
    }
}
