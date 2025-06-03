<?php

namespace App\Notifications\AdminNotifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DatabaseUpdateSuccess extends Notification implements ShouldQueue
{
    use Queueable;

    protected $databaseName;

    /**
     * Create a new notification instance.
     *
     * @param string $databaseName
     * @return void
     */
    public function __construct(string $databaseName)
    {
        $this->databaseName = $databaseName;
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
        return (new MailMessage)
            ->subject('Database Update Successful')
            ->greeting('Hello Admin!')
            ->line('The database "' . $this->databaseName . '" has been successfully updated.')
            ->line('This is an automated notification from your system.')
            ->line('Thank you for using our application!');
    }
} 