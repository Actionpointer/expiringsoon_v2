<?php

namespace App\Listeners;

use App\Events\SettleVendor;
use App\Models\Settlement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SettlingVendor
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SettleVendor  $event
     * @return void
     */
    public function handle(SettleVendor $event)
    {
        $settlements = $event->order->settlements->where('receiver_type','App\Models\Store');
        if($settlements->isNotEmpty()){
            $shop = $event->order->shop;
            $shop->wallet += $settlements->sum('amount');
            $shop->save();
            Settlement::whereIn('id',[$settlements->pluck('id')->toArray()])->update(['status'=>true]);
        }
        
    }
}
