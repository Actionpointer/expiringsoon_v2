<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusCustomerNotification extends Notification
{
    use Queueable;
    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        if($this->order->status == 'processing'){
            $view = 'emails.receipt';
        }
        if($this->order->status == 'shipped'){
            $view = 'emails.shipped';
        }
        if($this->order->status == 'delivered'){
            $view = 'emails.delivered';
        }
        if($this->order->status == 'completed'){
            $view = 'emails.completed';
        }
        return (new MailMessage)->subject('Welcome Aboard')->view(
            $view, ['user' => $notifiable]
        );
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
