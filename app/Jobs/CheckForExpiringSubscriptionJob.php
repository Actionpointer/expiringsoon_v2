<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Feature;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\FeatureStatusNotification;
use App\Notifications\SubscriptionStatusNotification;


class CheckForExpiringSubscriptionJob implements ShouldQueue
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
        $subscriptions = Subscription::where('status','true')->where(function ($query) {
            return $query->whereDate('end_at',today()->format('Y-m-d'))->orWhereBetween('end_at',[now(),now()->addDays(7)])->orWhereBetween('end_at',[now(),now()->addDays(2)]);})->get();

        $users = User::whereIn('id',$subscriptions->pluck('user_id')->toArray())->get();
        Notification::send($users,new SubscriptionStatusNotification);
        //do same for features
        $features = Feature::where('status','true')->where(function ($query) {
            return $query->whereDate('end_at',today()->format('Y-m-d'))->orWhereBetween('end_at',[now(),now()->addDay()]);})->get();
        $users = User::whereIn('id',$features->unique('user_id')->pluck('user_id')->toArray())->get();
        Notification::send($users,new FeatureStatusNotification);
    }
}
