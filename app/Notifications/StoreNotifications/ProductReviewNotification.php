<?php

namespace App\Notifications\StoreNotifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\StoreNotification\VendorAlertNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ProductReviewNotification extends Notification
{
    use Queueable;
    public $review;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
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
        $this->review->product->shop->user->notify(new VendorAlertNotification($this->review->product->shop));
        return [
            'subject' => 'New Product Review',
            'body' => 'You have a new review on '.$this->review->product->name.'. Check it out!',
            'url'=> route('product.show',$this->review->product),
            'id'=> $this->review->product_id,
            'related_to'=> 'product'
        
        ];
    }
}
