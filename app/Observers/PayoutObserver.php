<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Payout;
use App\Notifications\PayoutStatusNotification;

class PayoutObserver
{

    public function updated(Payout $payout){
        if($payout->isDirty('status') && in_array($payout->status,['approved','processing','paid'])){
            $payout->shop->notify(new PayoutStatusNotification($payout));
        }
        if($payout->isDirty('status') && $payout->paid_at){
            $admin = User::where('country_id',$payout->shop->country_id)->whereHas('role',function($query){
                        $query->where('name','admin');})->first();
            $admin->notify(new PayoutStatusNotification($payout));
        }
        
    }

}
