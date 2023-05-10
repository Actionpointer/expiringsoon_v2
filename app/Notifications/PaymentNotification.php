<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentNotification extends Notification
{
    use Queueable;
    public $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        $purpose = $this->payment->items->first()->paymentable_type;
        switch($purpose){
            case 'App\Models\Order': $url = route('orders');
                break;
            case 'App\Models\Subscription': $url = route('vendor.dashboard');
                break;
            case 'App\Model\Adset': $url = route('vendor.adsets');
                break;
        }
        return [
            'subject' => 'Payment Received',
            'body' => 'Payment Received for '.str_replace('App\Models\\','',$purpose),
            'url'=> $url,
            'id'=> $this->payment->id
        ];
    }
}
