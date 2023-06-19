<?php

namespace App\Http\Controllers\Shopper;

use App\Models\Cart;
use App\Models\Like;
use App\Models\Rate;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\WishlistTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;


class SalesController extends Controller
{
    use CartTrait,WishlistTrait,PaymentTrait;
    
    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function wishlist(){
        $user = auth()->user();
        $likes = Like::where('user_id',$user->id)->get();
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $likes->count() ? 'Wishlist retrieved Successfully':'No item in wishlist',
                'data' => ProductResource::collection(Product::whereIn('id',$likes->pluck('product_id')->toArray())->get()),
                'count' => $likes->count()
            ], 200) :
            view('customer.wishlist',compact('likes'));
    }

    public function follow(Shop $shop){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $user->following()->toggle([$shop->id]);
        return response()->json(['status'=> true],200);
    }

    public function unfollow(Shop $shop){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $user->following()->toggle([$shop->id]);
        return response()->json(['status'=> true],200);
    }



    public function checkout(Shop $shop = null){
        
        $user = auth()->user();
        $items = session('carts');
        if(!isset($items)){
            return redirect()->back();
        }
        foreach($items as $key => $value){
            $product = Product::find($value['product_id']);
            if(!$product->certified()){
                $this->removeFromCartDb($product);
                $carts = $this->removeFromCartSession($product);
            }
        }
        $carts = Cart::where('user_id',$user->id);
        if($shop){
            $carts = $carts->where('shop_id',$shop->id);
        }
        $carts = $carts->get();
        if($carts->isEmpty()){
            return redirect()->route('cart')->with(['result'=> 0,'message'=> 'Some items are no longer available ']);
        }
        $order = $this->getOrder($carts);

        $rates = Rate::where('country_id',$user->country_id)->whereNull('shop_id')->orWhereIn('shop_id',$carts->pluck('shop_id')->toArray())->get();
        return view('frontend.checkout',compact('carts','user','order','rates'));
    }

    public function checkout_api(Request $request){
        $user = auth()->user();
        if(!$request->address_id){
            if($user->addresses->isNotEmpty())
                $state_id = $user->addresses->firstWhere('main',true)->state_id;
            else $state_id = 0;
        }else{
            $state_id = Address::find($request->address_id)->state_id;
        }
        $carts = Cart::where('user_id',$user->id)->whereHas('product',function($query){
            $query->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible();
        })->get();
        Cart::where('user_id',$user->id)->whereNotIn('id',$carts->pluck('id')->toArray())->delete();
        if($carts->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'Cart is Empty',
            ],401);
        }
        foreach($carts->groupBy('shop_id') as $key=>$group){
            $shops[] = ['id'=> $key,'name'=> $group->first()->shop->name,
            'location'=> ($group->first()->shop->city ? $group->first()->shop->city->name.', ' : '').$group->first()->shop->state->name,
            'delivery_amount' => $this->getShopShipment($carts,$key,$state_id)['amount'],
            'delivery_hours' => $this->getShopShipment($carts,$key,$state_id)['hours']];
        }
        $order = $this->getOrder($carts);
        return response()->json([
            'status' => true,
            'message' => 'Checkout for selected address',
            'data' => ['carts'=> $carts->pluck('id')->toArray(),'shops'=> $shops,'order'=> $order,'currency'=> $carts->first()->shop->country->currency->symbol]
        ],200);
    } 

    public function shipment(Request $request){
        $carts = $request->carts;
        $address_id = $request->address_id;
        return response()->json($this->getEachShipment($carts,$address_id),200);
    }

    public function confirmcheckout(Request $request){
        try{
            if(!count($request->carts)){
                return request()->expectsJson() ?
                response()->json([
                   'status' => false,
                   'message'=> 'Cart cannot be empty'
               ], 401) :
               redirect()->back()->with(['result'=> '0','message'=> 'Cart cannot be empty']);
            }
            if(!$request->address_id && array_sum(array_values($request->deliveries)) ){
                return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> 'Delivery Address must be set'
                ], 401) :
                redirect()->back()->with(['result'=> '0','message'=> 'Delivery Address must be set']);
            }
            $user = auth()->user();
            $carts = Cart::whereIn('id',$request->carts)->get();
            $vat = $user->country->vat;
            $address = Address::find($request->address_id);
            $orders = collect([]);
            $shipping = ['amount'=> 0,'shipper'=> 'pickup','hours'=> 0,'by'=>'pickup'];
            foreach($carts->pluck('shop_id')->unique()->toArray() as $shop_id){
                $subtotal = 0;
                if($request->deliveries[$shop_id]){
                    $shipping = $this->getShopShipment($carts,$shop_id,$address->state_id); 
                }
                //dd($shipping_fee);
                $order = Order::create(['shop_id'=> $shop_id,'user_id'=> $user->id,'address_id'=> $request->address_id,
                    'deliveryfee' => $shipping['amount'],'deliverer'=> $shipping['by'],'expected_at'=> $shipping['hours'] ? now()->addHours($shipping['hours']) : null
                ]);
                if($shipping['by'] == 'admin'){
                    $shipment = Shipment::create(['address_id'=> $address->id,'rate_id'=> $shipping['rate_id'],'order_id'=> $order->id,'amount'=> $shipping['amount']]); 
                } 
                foreach($carts->where('shop_id',$shop_id) as $cart){
                    $order_item = OrderItem::create(['order_id'=> $order->id,'product_id'=> $cart->product_id,'quantity'=> $cart->quantity,'amount'=> $cart->amount,'total'=> $cart->quantity * $cart->amount]);
                    $subtotal += $cart->total;
                }
                $order->subtotal = $subtotal;
                $order->vat = $vat * $subtotal / 100;
                $order->total = ($vat * $subtotal / 100) + $subtotal + $order->deliveryfee;
                $order->save();
                $orders->push($order);
            }
            //take payment
            $result = $this->initializePayment($orders->sum('total'),$orders->pluck('id')->toArray(),'App\Models\Order');
            if(!$result['link']){
                return request()->expectsJson() ? 
                    response()->json([
                        'status' => false,
                        'message' => 'Something went wrong',
                    ], 401) :
                    redirect()->back()->with(['result'=> 0,'message'=> 'Something went wrong, Please try again later']);
            }else{
                return request()->expectsJson() ? 
                response()->json([
                    'status' => true,
                    'message' => 'Open payment link on browser to complete payment',
                    'data' => $result,
                ], 200) :
                redirect()->to($result['link']);
            }    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function confirmcheckout_api(Request $request){
        try{
            if(!count($request->carts)){
                return request()->expectsJson() ?
                response()->json([
                   'status' => false,
                   'message'=> 'Cart cannot be empty'
               ], 401) :
               redirect()->back()->with(['result'=> '0','message'=> 'Cart cannot be empty']);
            }
            if(!$request->address_id && array_sum(array_column($request->deliveries,'delivery_amount'))){
                return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> 'Delivery Address must be set'
                ], 401) :
                redirect()->back()->with(['result'=> '0','message'=> 'Delivery Address must be set']);
            }
            $user = auth()->user();
            $carts = Cart::whereIn('id',$request->carts)->get();
            $vat = $user->country->vat;
            $address = Address::find($request->address_id);
            $orders = collect([]);
            $shipping = ['amount'=> 0,'shipper'=> 'pickup','hours'=> 0,'by'=>'pickup'];
            $deliveries = collect($request->deliveries);
            foreach($carts->pluck('shop_id')->unique()->toArray() as $shop_id){
                $subtotal = 0;
                if($deliveries->firstWhere('shop_id',$shop_id)['delivery_amount']){
                    $shipping = $this->getShopShipment($carts,$shop_id,$address->state_id); 
                }
                //dd($shipping_fee);
                $order = Order::create(['shop_id'=> $shop_id,'user_id'=> $user->id,'address_id'=> $request->address_id,
                    'deliveryfee' => $shipping['amount'],'deliverer'=> $shipping['by'],'expected_at'=> $shipping['hours'] ? now()->addHours($shipping['hours']) : null
                ]);
                if($shipping['by'] == 'admin'){
                    $shipment = Shipment::create(['address_id'=> $address->id,'rate_id'=> $shipping['rate_id'],'order_id'=> $order->id,'amount'=> $shipping['amount']]); 
                } 
                foreach($carts->where('shop_id',$shop_id) as $cart){
                    $order_item = OrderItem::create(['order_id'=> $order->id,'product_id'=> $cart->product_id,'quantity'=> $cart->quantity,'amount'=> $cart->amount,'total'=> $cart->quantity * $cart->amount]);
                    $subtotal += $cart->total;
                }
                $order->subtotal = $subtotal;
                $order->vat = $vat * $subtotal / 100;
                $order->total = ($vat * $subtotal / 100) + $subtotal + $order->deliveryfee;
                $order->save();
                $orders->push($order);
            }
            //take payment
            $result = $this->initializePayment($orders->sum('total'),$orders->pluck('id')->toArray(),'App\Models\Order');
            if(!$result['link']){
                return request()->expectsJson() ? 
                    response()->json([
                        'status' => false,
                        'message' => 'Something went wrong',
                    ], 401) :
                    redirect()->back()->with(['result'=> 0,'message'=> 'Something went wrong, Please try again later']);
            }else{
                return request()->expectsJson() ? 
                response()->json([
                    'status' => true,
                    'message' => 'Open payment link on browser to complete payment',
                    'data' => $result,
                ], 200) :
                redirect()->to($result['link']);
            }    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }   

    }


    
    
}
