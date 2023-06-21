<?php

namespace App\Observers;

use App\Models\Revenue;
use App\Models\Settlement;

class SettlementObserver
{
    /**
     * Handle the Settlement "created" event.
     *
     * @param  \App\Models\Settlement  $settlement
     * @return void
     */
    public function created(Settlement $settlement)
    {

        if($settlement->status){
            Revenue::create(['country_id'=> $settlement->receiver->country_id,'currency_id'=> $settlement->receiver->country->currency_id,
            'amount'=> $settlement->charges,'description'=> $settlement->description]);
        }
    }

    public function updated(Settlement $settlement)
    {

        if($settlement->isDirty('status') && $settlement->status){
            Revenue::create(['country_id'=> $settlement->receiver->country_id,'currency_id'=> $settlement->receiver->country->currency_id,
            'amount'=> $settlement->charges,'description'=> $settlement->description]);
        }
    }

    public function deleted(Settlement $settlement)
    {
        //
    }

    
    public function restored(Settlement $settlement)
    {
        //
    }

    
    public function forceDeleted(Settlement $settlement)
    {
        //
    }
}
