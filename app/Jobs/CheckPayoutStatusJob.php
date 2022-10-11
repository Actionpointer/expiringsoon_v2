<?php

namespace App\Jobs;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use App\Http\Traits\PayoutTrait;
use App\Events\CheckPayoutStatus;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CheckPayoutStatusJob implements ShouldQueue,ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PayoutTrait;

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
        $payouts = Payout::whereIn('status',['processing'])->whereNotNull('transfer_id')->get();
        foreach($payouts as $payout){
            event(new CheckPayoutStatus($payout));
        }
    }
}
