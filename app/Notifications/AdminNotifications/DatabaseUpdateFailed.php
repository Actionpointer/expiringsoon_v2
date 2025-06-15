<?php

namespace App\Notifications\AdminNotifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DatabaseUpdateFailed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $errorMessage;

    /**
     * Create a new notification instance.
     *
     * @param string $errorMessage
     * @return void
     */
    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
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
            ->subject('Database Update Failed')
            ->greeting('Hello Admin!')
            ->error()
            ->line('There was an error while updating the database:')
            ->line($this->errorMessage)
            ->line('Please check the system logs for more details.')
            ->line('This is an automated notification from your system.');
    }
} 