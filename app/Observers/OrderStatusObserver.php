<?php

namespace App\Observers;

use App\Models\User;
use App\Events\AdjustCart;
use App\Models\Settlement;
use App\Events\RefundBuyer;
use App\Models\OrderStatus;
use App\Events\SettleVendor;
use App\Events\OrderPurchased;
use App\Events\DecreaseProduct;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderShipmentNotification;
use App\Notifications\OrderStatusVendorNotification;
use App\Notifications\OrderStatusCustomerNotification;

class OrderStatusObserver
{
    /**
     * Handle the OrderStatus "created" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function created(OrderStatus $orderStatus)
    {
        OrderStatus::where('order_id',$orderStatus->order_id)->where('name','!=',$orderStatus->name)->delete();

        switch($orderStatus->name){
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
        event(new DecreaseProduct($orderStatus->order));
        event(new AdjustCart($orderStatus->order));
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus->order));
        
    }

    public function cancelled(OrderStatus $orderStatus){
        event(new RefundBuyer($orderStatus->order,$orderStatus->order->total));
    }

    public function ready(OrderStatus $orderStatus){
        if($orderStatus->order->deliverer == "admin"){
            Notification::send(User::where('role','admin')->get(),new OrderShipmentNotification($orderStatus->order));
        }else{
            $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus->order));
        }
    }

    public function shipped(OrderStatus $orderStatus){
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus->order));
    }

    public function delivered(OrderStatus $orderStatus)
    {
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus->order));
    }
    
    public function completed(OrderStatus $orderStatus)
    {
        event(new SettleVendor($orderStatus->order));
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus->order));
    }

    public function rejected(OrderStatus $orderStatus)
    {
        //delete one settlement where description is vendor commission
        Settlement::where('order_id',$orderStatus->order_id)->where('description','Commission')->delete();
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus->order));
    }
    
    public function returned(OrderStatus $orderStatus)
    {
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus->order));
    }

    public function refunded(OrderStatus $orderStatus)
    {
        event(new RefundBuyer($orderStatus->order,$orderStatus->order->subtotal));
        event(new SettleVendor($orderStatus->order));
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus->order));
    }

    public function disputed(OrderStatus $orderStatus)
    {
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus->order));
        $orderStatus->order->user->notify(new OrderStatusCustomerNotification($orderStatus->order));
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
        $orderStatus->order->shop->notify(new OrderStatusVendorNotification($orderStatus->order));
    }
    
}
