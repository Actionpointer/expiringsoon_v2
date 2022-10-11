<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Account;
use App\Notifications\WelcomeNotification;

class UserObserver
{
    
    public function created(User $user)
    {
        switch($user->role){
            case 'shopper': $user->notify(new WelcomeNotification);
                break;
            case 'vendor': 
                break;
            default:
                break;
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
            if($user->staff->where('role','owner')->isNotEmpty()){
                $shops = $user->staff->where('role','owner')->pluck('shop_id')->toArray();
                Account::whereIn('shop_id',$shops)->update(['status'=> false]);
            }
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
