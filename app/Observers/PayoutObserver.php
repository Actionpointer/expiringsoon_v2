<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Payout;
use App\Notifications\PayoutStatusNotification;

class PayoutObserver
{

    public function updated(Payout $payout){
        $payout->shop->notify(new PayoutStatusNotification($payout));
    }

}
