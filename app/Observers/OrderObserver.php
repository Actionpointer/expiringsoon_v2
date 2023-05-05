<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Settlement;

class OrderObserver
{
    
    public function created(Order $order)
    {
        if($order->deliveryfee){
            $admin = User::where('role_id',Role::where('name','superadmin')->first()->id)->first();
            Settlement::create(['description'=> 'Shipment','order_id'=> $order->id,
            'receiver_id' => $order->deliverer == 'admin' ? $admin->id : $order->shop_id,
            'receiver_type' => $order->deliverer == 'admin' ? 'App\Models\User' : 'App\Models\Shop',
            'amount' => $order->deliveryfee,'status'=> $order->deliverer == 'admin'? true:false]);
        }
    }

    
    public function updated(Order $order)
    {
        if($order->isDirty('subtotal') && $order->subtotal){
            $commission_percentage = 100 - $order->shop->user->subscription->plan->commission_percentage;
            $commission_fixed = $order->shop->user->subscription->plan->commission_fixed;
            $commission = ($commission_percentage * $order->subtotal / 100) - $commission_fixed;
            Settlement::create(['description'=> 'Commission','order_id'=> $order->id, 
            'receiver_id' => $order->shop_id, 'receiver_type' => 'App\Models\Shop', 'amount' => $commission]);
        }
        
        
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
