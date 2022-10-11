<?php

namespace App\Jobs;

use App\Events\RetryPayout;
use App\Models\Payout;
use Illuminate\Bus\Queueable;
use App\Http\Traits\PayoutTrait;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class RetryPayoutJob implements ShouldQueue,ShouldBeUnique
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

    public function uniqueId()
    {
        return $this->payout->id;
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
