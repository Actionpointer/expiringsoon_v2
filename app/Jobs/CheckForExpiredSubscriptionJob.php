<?php

namespace App\Jobs;

use App\Models\Feature;
use App\Events\RenewFeature;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use App\Events\RenewSubscription;
use App\Events\SubscriptionExpired;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

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
        foreach($subscriptions as $sub){
            event(new SubscriptionExpired($sub));
        }
        $features = Feature::where('status',true)->expired()->get();
        Feature::whereIn('id',$features->pluck('id')->toArray())->update(['status'=> false]);
    }
}
