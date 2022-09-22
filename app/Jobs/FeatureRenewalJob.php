<?php

namespace App\Jobs;

use App\Models\Feature;
use App\Events\RenewFeature;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class FeatureRenewalJob implements ShouldQueue
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
        $features = Feature::where('auto_renew',true)->where(function ($query) {
            return $query->where('end_at','>',now()->subHours(2))->orWhere('end_at','>=',now());})->get();
            foreach($features as $feat){
                event(new RenewFeature($feat));
            }
    }
}
