<?php

namespace App\Events;

use App\Models\Payout;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RetryPayout
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $payout;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payout $payout)
    {
        $this->payout = $payout;
    }

    
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
