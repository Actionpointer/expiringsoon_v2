<?php

namespace App\Jobs;


use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use App\Http\Traits\OptimizationTrait;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\StoreNotification\SubscriptionStatusNotification;

class SubscriptionExpiredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,OptimizationTrait;

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
        
        $subscriptions = Subscription::whereNotNull('end_at')->where('end_at','<',now())->where('end_at','>',now()->subHour())->get();
        foreach($subscriptions as $subscription){
            $subscription->user->notify(new SubscriptionStatusNotification($subscription));
            $subscription->delete(); 
        }
    }
}
