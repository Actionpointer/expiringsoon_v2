<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Account;
use App\Models\Subscription;
use App\Notifications\WelcomeNotification;

class UserObserver
{
    
    public function created(User $user)
    {
        
        if($user->role->name == 'vendor' && !$user->shop_id){
            $subscription = Subscription::create(
                ['user_id'=> $user->id,
                'plan_id'=> 1,
                'amount'=> 0.0,
                'start_at'=> now(),
                'renew_at'=> null,
                'end_at'=> null,
                'coupon' => null,
                'status'=> 1,
                'auto_renew'=> false
            ]);
            $user->subscription_id = $subscription->id;
            $user->save();
        }
        try{
            $user->notify(new WelcomeNotification);
        }catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if($user->isDirty('fname') || $user->isDirty('fname')){
            if($user->idcard){
                $user->idcard->status = false;
                $user->idcard->reason = 'User new name does not match idcard';
                $user->idcard->save();
            }

            
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
