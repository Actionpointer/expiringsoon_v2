<?php

namespace App\Notifications\StoreNotifications;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ShopStatusNotification extends Notification
{
    use Queueable;
    public $shop;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Shop Approval/Disapproval
     *
     * 
     * 
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'emails.shops', ['shop'=> $this->shop]
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
            // 'subject' => 'Payout '.$this->payout->status,
            // 'body' => $message,
            // 'url'=> $notifiable->id == $this->payout->user_id ? route('vendor.shop.payouts',$this->payout->shop,$this->payout) : route('admin.payouts'),
            // 'id'=> $this->payout->id,
            // 'related_to'=> 'payout'
        ];
    }
}
