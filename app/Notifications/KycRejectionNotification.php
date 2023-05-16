<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Kyc;

class KycRejectionNotification extends Notification
{
    use Queueable;
    public $kyc;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Kyc $kyc)
    {
        $this->kyc = $kyc;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('KYC Document Rejected')
                    ->line('The '.$this->kyc->type.' document you submitted was rejected')
                    ->line('Reason: '.$this->kyc->reason)
                    ->line('You will need to submit valid documents to have your account fully operational')
                    ->action('Submit Documents', route('vendor.dashboard'))
                    ->line('Thank you for using ExpiringSoon!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
