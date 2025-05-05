<?php

namespace App\Notifications\StoreNotifications;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewStoreNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Store $store)
    {
        $this->store = $store;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Store Dashboard', url(config('app.url').'/stores/'.$this->store->slug.'/dashboard'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'subject' => 'New Store Created',
            'body' => 'Manage your store from the dashboard',
            'url' => url(config('app.url').'/stores/'.$this->store->slug.'/dashboard'),
        ];
    }
}
