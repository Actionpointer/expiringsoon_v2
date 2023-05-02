<?php

namespace App\Notifications;

use App\Mail\CourierEmail;
use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderShipmentNotification extends Notification
{
    use Queueable;
    public $shipment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
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

    public function message(){
        if(!$this->shipment->ready_at){
            $message = 'Please expect a pickup and delivery of some packages on or before'.$this->shipment->created_at->addHours(cache('order_processing_to_shipment_period'))->format('M,jS');
        }       
        elseif(!$this->shipment->shipped_at){
            $message = 'You have some packages for pickup and delivery. Kindly check your email for further instructions';
        }       
        elseif(!$this->shipment->delivered_at){
            $message = 'Thank you for the delivery.';
        }     

    }

    public function toMail($notifiable)
    {
        return (new CourierEmail($this->shipment))->to($this->shipment->rate->company_email);
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
            'message'=> $this->message()
        ];
    }
}
