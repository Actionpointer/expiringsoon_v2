<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Shipment;
use App\Models\Settlement;
use App\Events\RefundBuyer;
use App\Models\OrderStatus;
use App\Events\SettleVendor;
use App\Models\OrderMessage;
use App\Events\OrderPurchased;
use App\Http\Traits\OptimizationTrait;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderShipmentNotification;
use App\Notifications\OrderStatusVendorNotification;
use App\Notifications\OrderStatusCustomerNotification;

class OrderStatusObserver
{
    use OptimizationTrait;
    /**
     * Handle the OrderStatus "created" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function created(OrderStatus $orderStatus)
    {
        OrderStatus::where('order_id',$orderStatus->order_id)->where('name','!=',$orderStatus->name)->delete();

        switch(strtolower($orderStatus->name)){
            case 'processing': $this->processing($orderStatus);
            break;
            case 'cancelled': $this->cancelled($orderStatus);
            break;
            case 'ready': $this->ready($orderStatus);
            break;
            case 'shipped': $this->shipped($orderStatus);
            break;
            case 'delivered': $this->delivered($orderStatus);
            break;
            case 'completed': $this->completed($orderStatus);
            break;
            case 'rejected': $this->rejected($orderStatus);
            break;
            case 'reversed': $this->reversed($orderStatus);
            break;
            case 'returned': $this->returned($orderStatus);
            break;
            case 'refunded': $this->refunded($orderStatus);
            break;
            case 'disputed': $this->disputed($orderStatus);
            break;
            case 'closed': $this->closed($orderStatus);
            break;
        }
    
    }

    public function processing(OrderStatus $orderStatus){
        event(new OrderPurchased($orderStatus->order));
        $this->decreaseProducts($orderStatus->order);
        $this->adjustCart($orderStatus->order);
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
        
    }

    public function cancelled(OrderStatus $orderStatus){
        $this->increaseProducts($orderStatus->order);
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
        event(new RefundBuyer($orderStatus->order,$orderStatus->order->total));
    }

    public function ready(OrderStatus $orderStatus){
        if($orderStatus->order->deliverer == "admin"){
            $shipment = Shipment::where('order_id',$orderStatus->order_id)->where('delivered_at',null)->first();
            $shipment->ready_at = now();
            $shipment->save();
            Notification::send(User::where('role','admin')->get(),new OrderShipmentNotification($shipment));
        }else{
            $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
        }
    }

    public function shipped(OrderStatus $orderStatus){
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
        if($orderStatus->order->deliverer == "admin"){
            $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
        }
    }

    public function delivered(OrderStatus $orderStatus)
    {
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
        if($orderStatus->order->deliverer == "admin"){
            $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
        }
    }
    
    public function completed(OrderStatus $orderStatus)
    {
        event(new SettleVendor($orderStatus->order));
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
    }

    public function rejected(OrderStatus $orderStatus)
    {
        //delete one settlement where description is vendor commission
        Settlement::where('order_id',$orderStatus->order_id)->where('description','Commission')->delete();
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
    }

    public function reversed(OrderStatus $orderStatus){
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
    }
    
    public function returned(OrderStatus $orderStatus)
    {
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
    }

    public function refunded(OrderStatus $orderStatus)
    {
        event(new RefundBuyer($orderStatus->order,$orderStatus->order->subtotal));
        event(new SettleVendor($orderStatus->order));
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
    }

    public function disputed(OrderStatus $orderStatus)
    {
        if($orderStatus->order->user_id != $orderStatus->user_id){
            $sender_id = $orderStatus->order->shop_id;
            $sender_type = 'App\Models\Shop';
            $receiver_id = $orderStatus->user_id;
            $receiver_type = 'App\Models\User';
        }else{
            $sender_id = $orderStatus->user_id; 
            $sender_type = 'App\Models\User';
            $receiver_id = $orderStatus->order->shop_id;
            $receiver_type = 'App\Models\Shop';
        }
        OrderMessage::create(['order_id'=> $orderStatus->order_id,'sender_id'=> $sender_id,'sender_type'=> $sender_type,'receiver_id'=> $receiver_id ,'receiver_type'=> $receiver_type, 'body'=> $orderStatus->description]);
        
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus));
    }

    public function closed(OrderStatus $orderStatus)
    {
        $dispute = $orderStatus->order->dispute;
        if($dispute->seller > 0){
            Settlement::create(['description'=> 'Commission','order_id'=> $orderStatus->order_id, 
            'receiver_id' => $orderStatus->order->shop_id, 'receiver_type' => 'App\Models\Shop', 'amount' => $orderStatus->order->subtotal * $dispute->seller / 100]);
        }
        if($dispute->buyer > 0){
            event(new RefundBuyer($orderStatus->order,$orderStatus->order->subtotal * $dispute->buyer / 100));
        }
        event(new SettleVendor($orderStatus->order));
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus));
    }
    
}
