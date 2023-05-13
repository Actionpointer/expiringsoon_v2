<?php

namespace App\Jobs;

use App\Models\Adset;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\AdsetStatusNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AdsetExpiredNotifyJob implements ShouldQueue
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

    
    public function handle()
    {
        $adsets = Adset::where('end_at','<',now())->where('end_at','>',now()->subHour())->get();
        foreach($adsets as $adset){
            $adset->user->notify(new AdsetStatusNotification($adset));
        }
    }
}
