<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderStatusVendorNotification extends Notification
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
        switch($this->order->status){
            case 'processing': $view = 'emails.receipt';
                break;
            case 'shipped': $view = 'emails.shipped';
                break;
            case 'delivered': $view = 'emails.delivered';
                break;
            case 'completed': $view = 'emails.completed';
                break;

        }
        return (new MailMessage)->view($view,['order' => $this->order]);
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'ourneworder';
    }

    
    public function toBroadcast($notifiable){
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'message' => 'Something happened to this order',
        ]);
    }

    
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Something happened to this order',
        ];
    }
}
