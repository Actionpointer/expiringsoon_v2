<?php
namespace App\Http\Traits;

// use App\Coupon;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Shop;
use App\Models\State;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\ShippingRate;
use Illuminate\Support\Facades\Auth;

trait OrderTrait
{

    protected function getOrder($carts = null){
        $cart = $carts ? $carts->toArray() : request()->session()->get('cart');
        if(!$cart)
        $order = ['subtotal'=> 0,'vat'=> 0,'vat_percent'=> $this->getVat(),'shipping'=> 0];
        else
        $order = ['subtotal'=> $this->getSubtotal($cart),'vat'=> $this->getVat()/100 * $this->getSubtotal($cart),'vat_percent'=>$this->getVat(),'shipping'=> $this->getShipping($cart)];
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

    protected function getVat(){
        $vat = Setting::where('name','vat')->first()->value;
        return $vat;
    }

    protected function getShipping(Array $cart){
        $user = auth()->user();
        $state_id = $user->addresses->where('main',true)->first() ? $user->addresses->where('main',true)->first()->state_id : 0;
        $shop_ids = array_unique(array_column($cart, 'shop_id'));
        $shops = Shop::whereIn('id',$shop_ids)->get();
        $shipping = 0;
        $company_rate = ShippingRate::whereNull('shop_id')->where('destination_id',$state_id)->first();
        foreach($shops as $shop){
            if($shop->shippingRates->isNotEmpty() && $shop->shippingRates->where('destination_id',$state_id)->first()){
                $shipping+= $shop->shippingRates->where('destination_id',$state_id)->first()->amount;
            }elseif($company_rate){
                $shipping+= $company_rate->amount;
            }else{
                $shipping+=0;
            }
        }
        return $shipping;
    }

    protected function getShopShipment($shop_id,$address_id = null){
        $hours = 0;
        $amount = 0;
        if($address_id)
            $state_id = Address::find($address_id)->state_id;
        else 
            $state_id = auth()->user()->state_id;
        if(ShippingRate::where('shop_id',$shop_id)->where('destination_id',$state_id)->first()){
            $hours = ShippingRate::where('shop_id',$shop_id)->where('destination_id',$state_id)->first()->hours;
            $amount = ShippingRate::where('shop_id',$shop_id)->where('destination_id',$state_id)->first()->amount;
        }elseif(ShippingRate::whereNull('shop_id')->where('destination_id',$state_id)->first()){
            $hours = ShippingRate::whereNull('shop_id')->where('destination_id',$state_id)->first()->hours;
            $amount = ShippingRate::whereNull('shop_id')->where('destination_id',$state_id)->first()->amount;
        }
        return ['hours'=> $hours,'amount'=>$amount];
    }

    protected function getEachShipment($carts,$address_id){
        $total = $this->getShipping($carts);
        $shop_ids = array_unique(array_column($carts, 'shop_id'));
        // dd($shop_ids);
        $result = [];
        foreach($shop_ids as $shopId){
            $res = $this->getShopShipment($shopId,$address_id);
            $result[] = array_merge($res,['shop_id'=> $shopId,'time'=> now()->addHours($res['hours'])->format('l jS \of\ F')]);
        }
        return ['total'=> $total,'shipments'=> $result];
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

    
    
    // protected function getCoupon($code){
    //     $cart = request()->session()->get('cart');
    //     if(!$cart)
    //     return $this->getWorth('No items in your cart');
    //     $worth = [];
    //     $coupon = Coupon::where('code',$code)->first();
    //     if(!$coupon)
    //         return $this->getWorth('Coupon does not exist');
    //     if(!$coupon->status)
    //         return $this->getWorth('Coupon is invalid');
    //     if(!$coupon->available)
    //         return $this->getWorth('Coupon is expired');
    //     if($coupon->start_at && $coupon->start_at > now())
    //         return $this->getWorth('Coupon is not available');
    //     if($coupon->end_at && $coupon->end_at < now())
    //         return $this->getWorth('Coupon is expired');
    //     if($coupon->meal_limit){
    //         $meal = false;
    //         foreach($cart as $item){
    //             foreach($coupon->meal_limit as $value){
    //                 if($item['type'] == 'App\Meal' && $value == $item['id'])
    //                 $meal = true;
    //             }
    //         }
    //         if(!$meal)
    //         return $this->getWorth('Coupon is not available for the items in your cart');
    //     }
    //     if($coupon->minimum_spend){
    //         $subtotal = $this->getSubtotal($cart);
    //         if($coupon->minimum_spend > $subtotal)
    //         return $this->getWorth("Your subtotal must be greater than $coupon->minimum_spend to avail this coupon");
    //     }
    //     if($coupon->maximum_spend){
    //         $subtotal = $this->getSubtotal($cart);
    //         if($coupon->maximum_spend < $subtotal)
    //         return $this->getWorth("Your subtotal must be lower than $coupon->maximum_spend to avail this coupon");
    //     }
    //     if($coupon->state_limit){
    //         $user = Auth::user();
    //         if(!$user)
    //         return $this->getWorth("You must login to avail coupon");
    //         if($user->addresses->isEmpty())
    //         return $this->getWorth("You must set address to avail this coupon");
    //         if(!in_array($user->addresses->where('status',true)->first()->state_id, $coupon->state_limit))
    //         return $this->getWorth("Coupon is not available in your state");
    //     }
    //     if($coupon->city_limit){
    //         $user = Auth::user();
    //         if(!$user)
    //         return $this->getWorth("You must login to avail coupon");
    //         if($user->addresses->isEmpty())
    //         return $this->getWorth("You must set address to avail this coupon");
    //         if(!in_array($user->addresses->where('status',true)->first()->city_id, $coupon->city_limit))
    //         return $this->getWorth("Coupon is not available in your city");
    //     }
        
    //     if($coupon->limit_per_user){
    //         $user = Auth::user();
    //         if(!$user)
    //         return $this->getWorth("You must login to avail coupon");
    //         $payment = Payment::where('user_id',$user->id)->where('coupon_id',$coupon->id)->count();
    //         if($coupon->limit_per_user <= $payment)
    //         return $this->getWorth("You have used this coupon before");
    //     }
    //     if($coupon->free_shipping){
    //         $user = Auth::user();
    //         if(!$user)
    //         return $this->getWorth("You must login to avail coupon");
    //         if($user->addresses->isEmpty())
    //         return $this->getWorth("You must set address to avail this coupon");
    //         return $this->getWorth('Free Shipping Coupon has been applied',$this->getDeliveryCharge());
    //     }
    //     if($coupon->is_percentage)
    //         return $this->getWorth('Discount has been applied to your order',$coupon->value /100 * $this->getSubtotal($cart));
    //     else
    //         return $this->getWorth('Discount has been applied to your order',$coupon->value); 
    // }

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

