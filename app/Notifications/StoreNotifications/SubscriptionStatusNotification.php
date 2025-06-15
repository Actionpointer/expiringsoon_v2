<?php

namespace App\Notifications\StoreNotifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionStatusNotification extends Notification
{
    use Queueable;
    public $subscription;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function status(){
        if($this->subscription->end_at <= now()){
            return 'expired';
        }elseif($this->subscription->renew_at <= now()){
            return 'expiring';
        }else{
            return 'activated';
        }
    }

    
    public function via($notifiable)
    {
        // return ['mail','database'];
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
        return (new MailMessage)->view('emails.subscription', ['subscription'=> $this->subscription,'status' => $this->status()]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if($this->subscription->end_at <= now()){
            $message = 'Your subscription of '.$this->subscription->plan->name.' has expired. You are now subscribed to Free Plan.';
        }elseif($this->subscription->renew_at <= now()){
            $message = 'Your subscription of '.$this->subscription->plan->name.' will expire on '.$this->subscription->end_at->format('d-M').'. Renew subscription on or before '.$this->subscription->renew_at->format('d-M');
        }else{
            $message = 'Your subscription of '.$this->subscription->plan->name.' has been activated';
        }
        return [
            'subject' => ucwords($this->status()).' Subscription',
            'body' => $message,
            'url' => route('vendor.dashboard'),
            'id'=> $this->subscription->user_id,
            'related_to'=> 'user'
        ];
    }
}
