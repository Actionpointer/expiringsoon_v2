<?php

namespace App\Notifications\UserNotifications;

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
            case 'ready': $view = 'emails.order.ready';
            break;
            case 'shipped': $view = 'emails.order.shipped';
            break;
            case 'delivered': $view = 'emails.order.delivered';
            break;
            case 'rejected': $view = 'emails.order.rejected';
            break;
            case 'reversed': $view = 'emails.order.reversed';
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
        switch($this->status->name){
            case 'processing': $subject = 'Order Processing'; $message = 'Your order with id '.$this->status->order->slug.' is in process. Thank you for shopping on ExpiringSoon';
            break;
            case 'cancelled': $subject = 'Order '.$this->status->order->slug.' Cancelled'; $message = 'Your order with id '.$this->status->order->slug.' has been cancelled';
            break;
            case 'ready': $subject = 'Order '.$this->status->order->slug.' Completed'; $message = 'Your order with id '.$this->status->order->slug.' is ready for pickup';
            break;
            case 'shipped': $subject = 'Order '.$this->status->order->slug.' Shipped'; $message = 'Your order with id '.$this->status->order->slug.' has been shipped';
            break;
            case 'delivered': $subject = 'Order '.$this->status->order->slug.' Delivered'; $message = 'Your order with id '.$this->status->order->slug.' has been delivered';
            break;
            case 'rejected':$subject = 'Order '.$this->status->order->slug.' Rejected'; $message = 'You rejected items in order with id '.$this->status->order->slug.'. We apologise for any inconvenience caused';
            break;
            case 'refunded': $subject = 'Order '.$this->status->order->slug.' Refunded'; $message = 'A refund has been initiated to you for order '.$this->status->order->slug.'. It may take 3 to 7 working days for funds to arrive in your account';
            break;
            case 'disputed': $subject = 'Order '.$this->status->order->slug.' in Dispute'; $message = 'Your order with id '.$this->status->order->slug.' is now in dispute';
            break;
            case 'closed': $subject = 'Order '.$this->status->order->slug.' Closed'; $message = 'Your order with id '.$this->status->order->slug.' has been closed';
            break;
        }
        return [
            'subject' => $subject,
            'body' => $message,
            'url'=> route('order.show',[$this->status->order]),
            'related_to'=> 'order',
        ];
    }
}
