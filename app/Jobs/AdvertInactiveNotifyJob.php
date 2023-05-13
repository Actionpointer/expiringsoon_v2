<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\AdvertStatusNotification;

class AdvertInactiveNotifyJob implements ShouldQueue
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
        //adverts
        $users = \App\Models\User::whereHas('adsets',function($query){
                    $query->active()->whereHas('adverts',function($puery){
                        $puery->where(function($wuery){
                            $wuery->where('advertable_type','App\Models\Product')->whereHas('product',function($pd){
                                $pd->isNotCertified();
                            })->orWhere('advertable_type','App\Models\Shop')->whereHas('shop',function($sh){
                                $sh->isNotCertified();
                            });
                        });
                    });
                })->get();
        Notification::send($users,new AdvertStatusNotification());
    }
}
