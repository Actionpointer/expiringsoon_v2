<?php

namespace App\Notifications;

use App\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusCustomerNotification extends Notification
{
    use Queueable;
    public $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(OrderStatus $status)
    {
        $this->status = $status;
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
        switch($this->status->name){
            case 'processing': $view = 'emails.order.processing';
            break;
            case 'cancelled': $view = 'emails.order.cancelled';
            break;
            // case 'ready': $view = 'emails.order.ready';
            // break;
            case 'shipped': $view = 'emails.order.shipped';
            break;
            case 'delivered': $view = 'emails.order.delivered';
            break;
            case 'refunded': $view = 'emails.order.refunded';
            break;
            case 'disputed': $view = 'emails.order.disputed';
            break;
            case 'closed': $view = 'emails.order.closed';
            break;
        }
        
        return (new MailMessage)->view(
            $view, ['user' => $notifiable,'order'=> $this->status->order,'status'=> $this->status]
        );
    }

    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
