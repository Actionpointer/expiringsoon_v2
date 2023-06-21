<?php

namespace App\Listeners;

use App\Models\Settlement;
use App\Events\RefundBuyer;
use App\Http\Traits\PaymentTrait;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefundingBuyer
{
    use PaymentTrait;
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
     * @param  \App\Events\RefundBuyer  $event
     * @return void
     */
    public function handle(RefundBuyer $event)
    {
         // $event->order->subtotal  should this amount be less the transfer fees?
        $settlement = Settlement::create(['description'=> 'Refund','order_id'=> $event->order->id, 
            'receiver_id' => $event->order->user_id, 'receiver_type' => 'App\Models\User', 'amount' => $event->amount,'charges'=>0]);
        $settlement->status = $this->initializeRefund($settlement);
        $settlement->save(); 
        
    }
}
