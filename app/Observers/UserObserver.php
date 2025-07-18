<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Account;
use App\Models\Rejection;
use App\Models\Subscription;
use App\Http\Traits\OptimizationTrait;
use App\Notifications\WelcomeNotification;

class UserObserver
{
    use OptimizationTrait;
    
    public function created(User $user)
    {
        
    }

    public function updated(User $user)
    {
        // if($user->isDirty('fname') || $user->isDirty('fname')){
        //     if($user->idcard){
        //         $user->idcard->status = false;
        //         $user->idcard->save();
        //         Rejection::create(['rejectable_id'=> $user->idcard->id,'rejectable_type'=> 'App\Models\Kyc','reason'=> 'User new name does not match idcard']);
        //     } 
        // }
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
