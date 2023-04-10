<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Adset;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use App\Events\SubscriptionExpired;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\AdsetStatusNotification;



class CheckForExpiredSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subscriptions = Subscription::where('status',true)->expired()->get();
        
        Subscription::whereIn('id',$subscriptions->pluck('id')->toArray())->update(['status'=> false]);
        $users = User::whereIn('id',$subscriptions->pluck('user_id')->toArray())->get();
        foreach($subscriptions as $sub){
            event(new SubscriptionExpired($sub));
        }
        $adsets = Adset::where('status',true)->expired()->get();
        $userz = User::whereIn('id',$adsets->pluck('user_id')->toArray())->get();
        Adset::whereIn('id',$adsets->pluck('id')->toArray())->update(['status'=> false]);
        Notification::send($userz,new AdsetStatusNotification);
    }
}
