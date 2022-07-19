<?php
namespace App\Http\Traits;

use App\City;
use App\Town;
use App\State;
use App\Coupon;
use App\Payment;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Traits\OrderTrait;
use Illuminate\Support\Facades\Auth;

trait OrderTrait
{

    protected function getOrder(){
        $cart = request()->session()->get('cart');
        if(!$cart)
        $order = ['subtotal'=> 0,'vat'=> 0,'vat_percent'=>$this->getVat()];
        else
        $order = ['subtotal'=> $this->getSubtotal($cart),'vat'=> $this->getVat()/100 *$this->getSubtotal($cart),'vat_percent'=>$this->getVat()];
        $grandtotal = $order['subtotal'] + $order['vat'];
        $order['grandtotal'] = $grandtotal;
        return $order;
    }

    // protected function getDeliveries(){
    //     $deliveries = [];
    //     $cart = request()->session()->get('cart');
    //     return $deliveries;
    // }

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

    protected function getVat(){
        $vat = Setting::where('name','vat')->first()->value;
        return $vat;
    }

    protected function getSubtotal(Array $cart){
        $subtotal = 0;
        foreach($cart as $item){
            $subtotal += $item['quantity'] * $item['product']->amount;
        }
        return $subtotal;
    }
    
    protected function getCoupon($code){
        $cart = request()->session()->get('cart');
        if(!$cart)
        return $this->getWorth('No items in your cart');
        $worth = [];
        $coupon = Coupon::where('code',$code)->first();
        if(!$coupon)
            return $this->getWorth('Coupon does not exist');
        if(!$coupon->status)
            return $this->getWorth('Coupon is invalid');
        if(!$coupon->available)
            return $this->getWorth('Coupon is expired');
        if($coupon->start_at && $coupon->start_at > now())
            return $this->getWorth('Coupon is not available');
        if($coupon->end_at && $coupon->end_at < now())
            return $this->getWorth('Coupon is expired');
        if($coupon->meal_limit){
            $meal = false;
            foreach($cart as $item){
                foreach($coupon->meal_limit as $value){
                    if($item['type'] == 'App\Meal' && $value == $item['id'])
                    $meal = true;
                }
            }
            if(!$meal)
            return $this->getWorth('Coupon is not available for the items in your cart');
        }
        if($coupon->minimum_spend){
            $subtotal = $this->getSubtotal($cart);
            if($coupon->minimum_spend > $subtotal)
            return $this->getWorth("Your subtotal must be greater than $coupon->minimum_spend to avail this coupon");
        }
        if($coupon->maximum_spend){
            $subtotal = $this->getSubtotal($cart);
            if($coupon->maximum_spend < $subtotal)
            return $this->getWorth("Your subtotal must be lower than $coupon->maximum_spend to avail this coupon");
        }
        if($coupon->state_limit){
            $user = Auth::user();
            if(!$user)
            return $this->getWorth("You must login to avail coupon");
            if($user->addresses->isEmpty())
            return $this->getWorth("You must set address to avail this coupon");
            if(!in_array($user->addresses->where('status',true)->first()->state_id, $coupon->state_limit))
            return $this->getWorth("Coupon is not available in your state");
        }
        if($coupon->city_limit){
            $user = Auth::user();
            if(!$user)
            return $this->getWorth("You must login to avail coupon");
            if($user->addresses->isEmpty())
            return $this->getWorth("You must set address to avail this coupon");
            if(!in_array($user->addresses->where('status',true)->first()->city_id, $coupon->city_limit))
            return $this->getWorth("Coupon is not available in your city");
        }
        
        if($coupon->limit_per_user){
            $user = Auth::user();
            if(!$user)
            return $this->getWorth("You must login to avail coupon");
            $payment = Payment::where('user_id',$user->id)->where('coupon_id',$coupon->id)->count();
            if($coupon->limit_per_user <= $payment)
            return $this->getWorth("You have used this coupon before");
        }
        if($coupon->free_shipping){
            $user = Auth::user();
            if(!$user)
            return $this->getWorth("You must login to avail coupon");
            if($user->addresses->isEmpty())
            return $this->getWorth("You must set address to avail this coupon");
            return $this->getWorth('Free Shipping Coupon has been applied',$this->getDeliveryCharge());
        }
        if($coupon->is_percentage)
            return $this->getWorth('Discount has been applied to your order',$coupon->value /100 * $this->getSubtotal($cart));
        else
            return $this->getWorth('Discount has been applied to your order',$coupon->value); 
    }

    protected function getWorth($description,$value = 0){
        $worth = ['value'=> $value,'description'=> $description];
        return $worth;
    }

    protected function getWeek($value){
        if($value < Carbon::now()->endOfWeek())
        return 'this week';
        else return 'next week';
    }
    
}

