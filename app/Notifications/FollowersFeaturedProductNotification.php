<?php

namespace App\Notifications;

use App\Models\Store;
use App\Models\Feature;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FollowersFeaturedProductNotification extends Notification
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
        $features = Feature::whereHas('product',function($qry){$qry->where('shop_id',$this->shop->id);})->whereHas('adset',function($query){ $query->active();})->get();
        return (new MailMessage)->subject('Featured Product')->view('emails.featured_products',['shop'=> $this->shop,'features'=> $features]);
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
            //
        ];
    }
}
