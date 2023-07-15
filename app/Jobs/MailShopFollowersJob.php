<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\FollowersFeaturedProductNotification;

class MailShopFollowersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    
    public function __construct(Array $data){
        $this->data = $data;
    }

    
    public function handle()
    {
        foreach($this->data as $shop){
            Notification::send($shop->followers,new FollowersFeaturedProductNotification($shop));
        }
    }
}
