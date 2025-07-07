<?php

namespace App\Notifications\StoreNotifications;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewStaffNotification extends Notification
{
    use Queueable;
    public $store;
    public $password;
    public $newlyCreated;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Store $store,$password,$newlyCreated)
    {
        $this->store = $store;
        $this->password = $password;
        $this->newlyCreated = $newlyCreated;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Welcome to '.$this->store->name)->view(
            'emails.user.staff', ['user' => $notifiable,'password'=> $this->password,'store'=> $this->store,'newUser'=> $this->newlyCreated]
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
            'subject' => $this->store->name.' Store Invitation',
            'body' => 'Join to manage store',
            'url'=> '',
            'related_to'=> 'store'
        ];
    }
}
