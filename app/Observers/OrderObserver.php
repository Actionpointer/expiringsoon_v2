<?php

namespace App\Observers;

use App\Models\Rate;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Settlement;
use App\Notifications\ArbitratorNotification;

class OrderObserver
{
    
    public function created(Order $order)
    {
        if($order->deliveryfee){
            if($order->deliverer == 'admin'){
                $admin = User::where('role_id',Role::where('name','superadmin')->first()->id)->first();
                Settlement::create(['description'=> 'Shipment','order_id'=> $order->id,
                'receiver_id' => $admin->id, 'receiver_type' => 'App\Models\User',
                'amount' => $order->deliveryfee,'charges'=> $this->getActual($order),'status'=> true]);
            }else{
                $shipment_percentage = 100 - $order->shop->user->subscription->plan->shipment_percentage;
                $shipment_fixed = $order->shop->user->subscription->plan->shipment_fixed;
                $shipment = ($shipment_percentage * $order->deliveryfee / 100) - $shipment_fixed;

                Settlement::create(['description'=> 'Shipment','order_id'=> $order->id,
                'receiver_id'=> $order->shop_id,'receiver_type'=>'App\Models\Shop',
                'amount'=> $shipment,'charges'=> $order->deliveryfee - $shipment,'status'=> false]);
            }
        }
    }

    
    public function updated(Order $order){
        if($order->isDirty('subtotal') && $order->subtotal){
            $commission_percentage = 100 - $order->shop->user->subscription->plan->commission_percentage;
            $commission_fixed = $order->shop->user->subscription->plan->commission_fixed;
            $commission = ($commission_percentage * $order->subtotal / 100) - $commission_fixed;
            Settlement::create(['description'=> 'Commission','order_id'=> $order->id, 
            'receiver_id' => $order->shop_id, 'receiver_type' => 'App\Models\Shop', 'amount' => $commission,
            'charges'=> $order->subtotal - $commission]);
        }
        if($order->isDirty('arbitrator_id') && $order->arbitrator_id){
            $user = User::find($order->arbitrator_id);
            $user->notify(new ArbitratorNotification($order));
        }
        
        
    }

    public function getActual(Order $order){
        $actual = Rate::whereNull('shop_id')->where('country_id',$order->user->country_id)
        ->where('origin_id',$order->shop->state_id)->where('destination_id',$order->address->state_id)->first()->actual;
        return $order->deliveryfee - $actual; 
    }

    public function deleted(Order $order)
    {
        //
    }

    
    public function restored(Order $order)
    {
        //
    }

    public function forceDeleted(Order $order)
    {
        //
    }
}
