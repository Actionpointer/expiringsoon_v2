<?php

namespace App\Notifications;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PayoutStatusNotification extends Notification
{
    use Queueable;
    public $payout;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payout $payout){
        $this->payout = $payout;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($this->payout->status == 'approved'){
            return ['database'];
        }else return ['mail'];
    }

    /**
     * pending, processing, approved, paid, rejected 
     *
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)->view(
            'emails.payout', ['payout' => $this->payout]
        );
    }

    
    public function toArray($notifiable)
    {
        
        switch($this->payout->status){
            case 'pending': $message = 'Payout of '.$this->payout->currency->iso.' '.$this->payout->amount.' has been requested and waiting your approval';
        
            break;
            case 'processing': $message = 'Payout of '.$this->payout->currency->iso.' '.$this->payout->amount.' is being processed';
            break;
            case 'approved': $message = 'Payout of '.$this->payout->currency->iso.' '.$this->payout->amount.' has been approved';
            break;
            case 'paid': $message = 'Payout of '.$this->payout->currency->iso.' '.$this->payout->amount.' has been paid';
            break;
            default: $message = 'Payout of '.$this->payout->currency->iso.' '.$this->payout->amount.' was '.$this->payout->status;
            break;
        }
        
        return [
            'subject' => 'Payout '.$this->payout->status,
            'body' => $message,
            'url'=> $notifiable->id == $this->payout->user_id ? route('vendor.shop.payouts',$this->payout->shop,$this->payout) : route('admin.payouts'),
            'id'=> $this->payout->id
        ];
    }
}
