<?php

namespace App\Jobs;

use App\Models\Payout;
use App\Events\RetryPayout;
use Illuminate\Bus\Queueable;
use App\Http\Traits\PayoutTrait;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PayoutRetryFailedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PayoutTrait;

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
        $payouts = Payout::where('status','failed')->get();
        foreach($payouts as $payout){
            $this->retryPayout($payout);
        }
        
    }
}
