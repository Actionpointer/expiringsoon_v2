<?php

namespace App\Notifications;

use App\Models\OrderMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderMessageNotification extends Notification
{
    use Queueable;
    public $orderMessage;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(OrderMessage $orderMessage)
    {
        $this->orderMessage = $orderMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable){
        return $this->orderMessage->order->status == 'disputed' ? ['mail','database'] : ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'emails.order.messages', ['orderMessage'=> $this->orderMessage]
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
        if($this->orderMessage->receiver_type == 'App\Models\User'){
            if($this->orderMessage->order->user_id == $this->orderMessage->receiver_id){
                $url = route('order.show',$this->orderMessage->order);
            }else{
                $url = route('admin.order.show',$this->orderMessage->order);
            }
        }else{
            $url = route('vendor.shop.order.view',[$this->orderMessage->order->shop,$this->orderMessage->order]);
        }
        return [
            'subject' => 'New Order Message',
            'body' => 'You have a new message for order #'.$this->orderMessage->order->slug,
            'url'=> $url
        ];
    }
}
