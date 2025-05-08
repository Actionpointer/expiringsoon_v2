<?php

namespace App\Notifications\StoreNotifications;

use App\Models\Adset;
use App\Models\Advert;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdvertStatusNotification extends Notification
{
    use Queueable;
    public $advert;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Advert $advert)
    {
        $this->advert = $advert;
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
        // $adsets = Adset::where('user_id',$notifiable->id)->active()->whereHas('adverts',function($puery){
        //             $puery->where(function($wuery){
        //                 $wuery->where('advertable_type','App\Models\Product')->whereHas('product',function($pd){
        //                     $pd->isNotCertified();
        //                 })->orWhere('advertable_type','App\Models\Store')->whereHas('shop',function($sh){
        //                 $sh->isNotCertified();
        //                 });
        //             });

        //         })->get();
        return (new MailMessage)->view('emails.adset.adverts',['advert' => $this->advert]);
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
