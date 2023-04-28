<?php

namespace App\Jobs;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\SubscriptionStatusNotification;

class ExpiringStatusUpdateJob implements ShouldQueue
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
        $subscriptions = Subscription::whereNotNull('end_at')->where('renew_at','<',now())->where('renew_at','>',now()->subHour())->get();
        foreach($subscriptions as $subscription){
            $subscriptions->user->notify(new SubscriptionStatusNotification($subscription));
        }
    }
}
