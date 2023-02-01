<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if($notifiable->role == 'vendor' && !$notifiable->shop_id){
            $view = 'emails.welcome_vendor';
        }
        if($notifiable->role == 'shopper'){
            $view = 'emails.welcome';
        }
        return (new MailMessage)->subject('Welcome Aboard')->view(
            $view, ['user' => $notifiable]
        );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
