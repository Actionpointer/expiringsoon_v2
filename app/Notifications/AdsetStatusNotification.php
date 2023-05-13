<?php

namespace App\Notifications;

use App\Models\Adset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdsetStatusNotification extends Notification
{
    use Queueable;
    public $adset;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Adset $adset)
    {
        $this->adset = $adset;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function status(){
        if($this->adset->end_at <= now()){
            return 'expired';
        }elseif($this->adset->status){
            return 'activated';
        }
    }

    
    public function toMail($notifiable)
    {
        return (new MailMessage)->view('emails.adset.status', ['adset'=> $this->adset,'status' => $this->status()]);
    }

    
    public function toArray($notifiable)
    {
        return [
            'subject' => 'Adset '.$this->status(),
            'body' => 'Your adset with id '.$this->adset->slug,
            'url'=> route('vendor.adsets'),
            'id'=> $this->adset->id,
            'related_to'=> 'adset'
        ];
    }
}
