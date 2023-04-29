<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderStatusVendorNotification extends Notification
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
        return ['mail', 'database'];
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
            // case 'delivered': $view = 'emails.order.delivered';
            // break;
            case 'completed': $view = 'emails.order.completed';
            break;
            case 'rejected': $view = 'emails.order.rejected';
            break;
            case 'returned': $view = 'emails.order.returned';
            break;
            // case 'refunded': $view = 'emails.order.refunded';
            // break;
            case 'disputed': $view = 'emails.order.disputed';
            break;
            case 'closed': $view = 'emails.order.closed';
            break;
        }
        return (new MailMessage)->view(
            $view, ['shop' => $notifiable,'order'=> $this->status->order,'status'=> $this->status]
        );
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'ourneworder';
    }

    
    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'order_id' => $this->status->id,
            'message' => 'Something happened to this order',
        ]);
    }

    
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->status->id,
            'message' => 'Something happened to this order',
        ];
    }
}
