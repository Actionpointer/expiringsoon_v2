<?php

namespace App\Jobs;

use App\Models\Payout;
use App\Events\RetryPayout;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PayoutRetryFailedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payouts = Payout::where('status','failed')->whereNotNull('transfer_id')->get();
        foreach($payouts as $payout){
            event(new RetryPayout($payout));
        }
        
    }
}
