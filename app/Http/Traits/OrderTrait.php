<?php
namespace App\Http\Traits;

// use App\Coupon;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Shop;
use App\Models\Order;
use App\Models\State;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\Setting;
use App\Models\Rate;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

trait OrderTrait
{

    protected function getOrder($carts = null){
        $user = auth()->user();
        $cart = isset($carts) ? $carts->toArray() : session('carts');
        if(!$cart)
        $order = ['subtotal'=> 0,'vat'=> 0,'vat_percent'=> $user->country->vat,'shipping'=> 0];
        else
        $order = ['subtotal'=> $this->getSubtotal($cart),'vat'=> $user->country->vat/100 * $this->getSubtotal($cart),'vat_percent'=> $user->country->vat,'shipping'=> $this->getEachShipment($cart)['total']];
        $grandtotal = $order['subtotal'] + $order['vat'] + $order['shipping'];
        $order['grandtotal'] = $grandtotal;
        return $order;
    }

    protected function getSubtotal(Array $cart){
        $subtotal = 0; 
        foreach($cart as $item){
            $amount = array_key_exists('product',$item) ?  $item['product']->amount : $item['amount'];
            $subtotal += $item['quantity'] * $amount;
        }
        return $subtotal;
    }

    protected function getShopShipment2($shop_id,$address_id = null){
        $user = auth()->user();
        if($address_id){
            $state_id = $user->addresses->where('id',$address_id)->first() ? $user->addresses->where('id',$address_id)->first()->state_id : 0;
        }else{
            $state_id = $user->addresses->where('main',true)->first() ? $user->addresses->where('main',true)->first()->state_id : 0;
        }
        $hours = 0;
        $amount = 0;
        $shipper = 'pickup';
        if(Rate::where('shop_id',$shop_id)->where('destination_id',$state_id)->first()){
            $hours = Rate::where('shop_id',$shop_id)->where('destination_id',$state_id)->first()->hours;
            $amount = Rate::where('shop_id',$shop_id)->where('destination_id',$state_id)->first()->amount;
            $shipper = 'vendor';
        }elseif(Rate::whereNull('shop_id')->where('destination_id',$state_id)->first()){
            $hours = Rate::whereNull('shop_id')->where('destination_id',$state_id)->first()->hours;
            $amount = Rate::whereNull('shop_id')->where('destination_id',$state_id)->first()->amount;
            $shipper = 'admin';
        }
        return ['hours'=> $hours,'amount'=>$amount,'shipper'=> $shipper];
    }

    protected function getShopShipment($shop_id,$state_id){
        $hours = 0;
        $amount = 0;
        $rate_id = null;
        $by = 'pickup';
        if($rate = Rate::where('shop_id',$shop_id)->where('destination_id',$state_id)->first()){
            $hours = $rate->hours;
            $amount = $rate->amount;
            $rate_id = $rate->id;
            $by = 'vendor';
        }elseif($rate = Rate::whereNull('shop_id')->where('destination_id',$state_id)->first()){
            $hours = $rate->hours;
            $amount = $rate->amount;
            $rate_id = $rate->id;
            $by = 'admin';
        }
        return ['hours'=> $hours,'amount'=>$amount,'rate_id'=> $rate_id,'by'=> $by];
    }

    protected function getEachShipment($carts,$address_id = null){
        $user = auth()->user();
        if($address_id){
            $state_id = $user->addresses->where('id',$address_id)->first() ? $user->addresses->where('id',$address_id)->first()->state_id : 0;
        }else{
            $state_id = $user->addresses->where('main',true)->first() ? $user->addresses->where('main',true)->first()->state_id : 0;
        }
        $shop_ids = array_unique(array_column($carts, 'shop_id'));
        $shipping = 0;
        $result = [];
        foreach($shop_ids as $shop_id){
            $trip = $this->getShopShipment($shop_id,$state_id);
            $shipping+= $trip['amount'];
            $result[] = array_merge($trip,['shop_id'=> $shop_id,'time'=> now()->addHours($trip['hours'])->format('l jS \of\ F')]);
        }
        return ['total'=> $shipping,'shipments'=> $result];
    
    }

    protected function getCustomerOrderStatuses(Order $order){
        $statuses = [];
        switch(strtolower($order->status)){
            case 'processing':
                if($order->statuses->firstWhere('name','processing')->created_at->addHours(cache('settings')['order_processing_to_user_cancel_period']) > now()) 
                $statuses = ['Cancel Order'=>'cancelled'];
            break;
            case 'ready':
                if($order->deliverer == "pickup") 
                $statuses = ['Received & Satisfied'=>'completed','I have issues with the order'=>'rejected'];
            break;
            case 'delivered':
                if($order->statuses->firstWhere('name','delivered')->created_at->addHours(cache('settings')['order_delivered_to_acceptance_period']) > now()) 
                $statuses = ['Received & Satisfied'=>'completed','I have issues with the order'=>'rejected','I did not receive the order'=> 'disputed'];
                break;
            case 'reversed':
                if($order->statuses->firstWhere('name','reversed')->created_at->addHours(cache('settings')['order_reversed_to_returned_period']) > now())
                $statuses = ['I have returned the items'=>'returned'];
                break;
            default: $statuses = [];
                break;
        }
        return $statuses;
    }

    protected function getVendorOrderStatuses(Order $order){
        $statuses = [];
        switch(strtolower($order->status)){
            case 'processing': 
                if(in_array($order->deliverer,["pickup","admin"])) $statuses = ['Mark Ready'=>'ready'];
                else $statuses = ['Mark Shipped'=>'shipped'];
            break;
            case 'ready':
                if($order->deliverer == "vendor") $statuses = ['Mark Delivered'=> 'delivered'];
            break;
            case 'shipped':
                if($order->deliverer == "vendor") $statuses = ['Mark Delivered'=> 'delivered'];
                break;
            case 'rejected':
                if($order->statuses->firstWhere('name','rejected')->created_at->addHours(cache('settings')['order_rejected_to_reversal_period']) > now())
                $statuses = ['Retrieve Items then Refund'=> 'reversed','Refund Customer'=>'refunded','Send new Items to Customer'=> 'processing'];
                break;
            case 'returned':
                $statuses = ['Received & OK'=>'refunded','Reject Returned Items'=>'disputed','I did not receive Items'=> 'disputed'];
                break;
            default: $statuses = [];
                break;
        }
        return $statuses;
    }

    protected function getLogisticsOrderStatuses(Order $order){
        $statuses = [];
        switch(strtolower($order->status)){
            case 'ready':
                if($order->deliverer == "admin") $statuses = ['Mark Shipped'=>'shipped','Delivered'=>'delivered'];
                break;
            case 'shipped':
                if($order->deliverer == "admin") $statuses = ['Mark Delivered'=>'delivered'];
                break;
            default: $statuses = [];
                break;
        }
        return $statuses;
    }


    // protected function getDeliveryCharge(){
    //     $state = State::all();
    //     $city = City::all();
    //     $delivery = 0;
    //     if(Auth::check() && $address = Auth::user()->addresses->where('status',true)->first()){
    //         //check if customer lives in same state with us
    //         if(in_array($address->state_id,$state->where('status',true)->pluck('id')->toArray())){
    //              //check if he lives in same city with us
    //             if(in_array($address->city_id,$city->where('status',true)->pluck('id')->toArray()))
    //                 $delivery = Setting::where('name','same_city_delivery_charge')->first()->value;
    //             elseif(in_array($address->city_id,$city->where('deliver_to',true)->pluck('id')->toArray()))
    //                 $delivery = Setting::where('name','same_state_delivery_charge')->first()->value;
    //         }
    //         elseif(in_array($address->state_id,$state->where('deliver_to',true)->pluck('id')->toArray()))
    //         $delivery = Setting::where('name','same_country_delivery_charge')->first()->value;
    //     }
    //     return $delivery * count($this->getDeliveries());
    // }

    
    
    protected function getCoupon($code,$amount){
        $coupon = Coupon::where('code',$code)->first();
        if(!$coupon)
            return ['description'=> 'Coupon does not exist','value'=> 0];
        if(!$coupon->status)
            return ['description'=> 'Coupon is invalid','value'=> 0];
        if(!$coupon->available)
            return ['description'=> 'Coupon is expired','value'=> 0];
        if($coupon->start_at && $coupon->start_at > now())
            return ['description'=> 'Coupon is not available','value'=> 0];
        if($coupon->end_at && $coupon->end_at < now())
            return ['description'=> 'Coupon is expired','value'=> 0];
        if($coupon->minimum_spend && $coupon->minimum_spend > $amount){
            return ['description'=> "Your subtotal must be greater than $coupon->minimum_spend to avail this coupon",'value'=> 0]; 
        }
        
        if($coupon->maximum_spend && $coupon->maximum_spend < $amount){
            return ['description'=> "Your subtotal must be lower than $coupon->maximum_spend to avail this coupon",'value'=> 0];
        }
        
        if($coupon->limit_per_user){
            if(!auth()->check()){
                return  ['description'=> "You must login to avail coupon",'value'=> 0];
            }
            $subscription = Subscription::where('user_id',auth()->id())->where('coupon',$code)->count();
            if($coupon->limit_per_user <= $subscription)
            return ['description'=> "You have used this coupon before",'value'=> 0];
        }

        if($coupon->is_percentage)
            return ['description'=> 'Discount has been applied to your order','value'=> $coupon->value /100 * $amount];
        else
            return ['description'=> 'Discount has been applied to your order','value'=> $coupon->value]; 
    }

    // protected function getWorth($description,$value = 0){
    //     $worth = ['value'=> $value,'description'=> $description];
    //     return $worth;
    // }

    // protected function getWeek($value){
    //     if($value < Carbon::now()->endOfWeek())
    //     return 'this week';
    //     else return 'next week';
    // }
    
}

