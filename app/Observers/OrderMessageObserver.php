<?php

namespace App\Observers;

use App\Models\Store;
use App\Models\User;
use App\Models\OrderMessage;
use App\Notifications\OrderMessageNotification;

class OrderMessageObserver
{
    
    public function created(OrderMessage $orderMessage)
    {
        if($orderMessage->receiver_type == 'App\Models\User'){
            $receiver = User::find($orderMessage->receiver_id);
        }else{
            $receiver = Shop::find($orderMessage->receiver_id);
        }
        $receiver->notify(new OrderMessageNotification($orderMessage));
    }

    
}
