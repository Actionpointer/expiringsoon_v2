<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use BeyondCode\LaravelWebSockets\WebSockets\Channels\PrivateChannel;

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

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toMail($notifiable)
    {
        $url = null;
        if(in_array($notifiable->role->name,['vendor','staff']) && !$notifiable->email_verified_at){
            $url = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
            // $view = 'emails.user.welcome_vendor';
        }
        // if($notifiable->role->name == 'shopper'){
        //     $view = 'emails.user.welcome';
        // }
        return (new MailMessage)->subject('Welcome Aboard')->view(
            'emails.user.welcome', ['user' => $notifiable,'url'=> $url]
        );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'message' => 'I Love you',
            'user' => 'Omobolarin Sweet',
            'id'=> $notifiable->id
        ]);
    }

}
