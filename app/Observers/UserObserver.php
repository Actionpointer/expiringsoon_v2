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
                $user->idcard->save();
                Rejection::create(['rejectable_id'=> $user->idcard->id,'rejectable_type'=> 'App\Models\Kyc','reason'=> 'User new name does not match idcard']);
            } 
        }
        session(['locale'=>  [ 'country_id'=> $user->country->id, 'country_name'=> $user->country->name, 'country_iso'=> $user->country->iso, 'state_name'=> $user->state->name, 'state_id'=> $user->state->id, 'dial'=> $user->country->dial, 'currency_id'=> $user->country->currency_id, 'currency_iso'=> $user->country->currency->iso, 'currency_name'=> $user->country->currency->name, 'currency_symbol'=> $user->country->currency->symbol] ]);
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
