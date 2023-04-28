<?php

namespace App\Jobs;

use App\Models\Adset;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\AdsetStatusNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\SubscriptionStatusNotification;

class ExpiredStatusUpdateJob implements ShouldQueue
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
        $adsets = Adset::where('end_at','<',now())->where('end_at','>',now()->subHour())->get();
        $subscriptions = Subscription::whereNotNull('end_at')->where('end_at','<',now())->where('end_at','>',now()->subHour())->get();
        foreach($adsets as $adset){
            $adset->user->notify(new AdsetStatusNotification($adset));
        }
        foreach($subscriptions as $subscription){
            $subscriptions->user->notify(new SubscriptionStatusNotification($subscription));
        }
    }
}
