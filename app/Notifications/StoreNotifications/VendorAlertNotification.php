<?php

namespace App\Notifications\StoreNotifications;

use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VendorAlertNotification extends Notification
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject' => $this->shop->name,
            'body' => 'You have a new shop notification',
            'url'=> route('vendor.shop.show',$this->shop),
            'id'=> $this->shop->id,
            'related_to'=> 'shop'
        ];
    }
}
