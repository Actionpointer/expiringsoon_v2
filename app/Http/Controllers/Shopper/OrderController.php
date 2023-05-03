<?php

namespace App\Http\Controllers\Shopper;

use App\Models\Cart;
use App\Models\City;
use App\Models\Like;
use App\Models\Rate;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Review;
use App\Models\Address;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderMessage;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\WishlistTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\OrderMessageResource;
use App\Notifications\OrderMessageNotification;

class OrderController extends Controller
{
    use CartTrait,WishlistTrait,PaymentTrait;
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    public function index(){
        $user = auth()->user();
        $orders = Order::where('user_id',$user->id)->whereHas('statuses')->get();
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $orders->count() ? 'Orders retrieved Successfully':'No Order',
                'data' => OrderResource::collection($orders),
                'count' => $orders->count()
            ], 200) :
            view('customer.orders.list',compact('user','orders')); 
    }
    
    public function show(Order $order){
        
        if(!request()->expectsJson()){
            OrderMessage::where('order_id',$order->id)->where('receiver_id',$order->user_id)->where('receiver_type','App\Models\user')->whereNull('read_at')->update(['read_at'=>now()]);
        }
        $messages = OrderMessage::where(function($query) use($order){
            return $query->where('order_id',$order->id)->where('receiver_id',$order->user_id)->where('receiver_type','App\Models\User');
        })->orWhere(function($qeury) use($order){
            return $qeury->where('order_id',$order->id)->where('sender_id',$order->user_id)->where('sender_type','App\Models\User');
        })->orderBy('created_at','desc')->get();
        $statuses = $this->getCustomerOrderStatuses($order);
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => $order->items->count() ? 'Order Details retrieved Successfully' :'No details retrieved',
                'data' => OrderDetailsResource::collection($order->items),
                'count' => $order->items->count()
            ], 200):
            view('customer.orders.view',compact('order','messages','statuses'));
    }

    public function update(Request $request){
        switch($request->status){
            
            case 'cancelled':
                    $message = 'Order has been cancelled and refund initiated';
                break;
            case 'completed': 
                    $message = 'Order has been completed';
                break;
            case 'rejected':
                $items = OrderItem::where('order_id',$request->order_id)->whereHas('product',function($query){
                    $query->isValid();
                })->get();

                if($items->isEmpty()){
                    return request()->expectsJson() ? 
                        response()->json([
                            'status' => false,
                            'message' => 'No item in the order is valid for return',
                        ], 401) :
                        redirect()->back()->with(['result'=> 0,'message'=> 'No item in the order is valid for return']);
                }
                $message = 'Order has been rejected';
                break;
            case 'returned':
                    $message = 'Order has been updated';
                break;
        }
        OrderStatus::create(['order_id'=> $request->order_id,'user_id'=> auth()->id(),'name'=> $request->status]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => $message,
        ], 200) :
         redirect()->back()->with(['result'=> 1,'message'=> $message]);
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


    public function checkout(Shop $shop = null){
        
        $user = auth()->user();
        $items = session('cart');
        if(!isset($items)){
            return redirect()->back();
        }
        foreach($items as $key => $value){
            $this->addToCartDb($value['product'],$value['quantity'],true);
        }
        $carts = Cart::where('user_id',$user->id);
        if($shop){
            $carts = $carts->where('shop_id',$shop->id);
        }
        $carts = $carts->whereHas('product',function($query) use($items){
                    $query->whereIn('product_id',array_keys($items))->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible();
                 })->get();
        $order = $this->getOrder($carts);
        $rates = Rate::where('country_id',$user->country_id)->whereNull('shop_id')->orWhereIn('shop_id',$carts->pluck('shop_id')->toArray())->get();
        return view('frontend.checkout',compact('carts','user','order','rates'));
    }

    public function shipment(Request $request){
        $carts = $request->carts;
        $address_id = $request->address_id;
        return response()->json($this->getEachShipment($carts,$address_id),200);
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
        foreach($carts->groupBy('shop_id') as $key=>$group){
            $shops[] = ['id'=> $key,'name'=> $group->first()->shop->name,
            'location'=> ($group->first()->shop->city ? $group->first()->shop->city->name.', ' : '').$group->first()->shop->state->name,
            'delivery_amount' => $this->getShopShipment($key,$state_id)['amount'],
            'delivery_hours' => $this->getShopShipment($key,$state_id)['hours']];
        }
        $order = $this->getOrder($carts);
        return response()->json([
            'status' => true,
            'message' => 'Checkout for selected address',
            'data' => ['carts'=> $carts->pluck('id')->toArray(),'shops'=> $shops,'order'=> $order,'currency'=> $carts->first()->shop->country->currency->symbol]
        ],200);
    } 

    public function confirmcheckout(Request $request){
        // dd($request->all());
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
                    $shipping = $this->getShopShipment($shop_id,$address->state_id); 
                }
                //dd($shipping_fee);
                $order = Order::create(['shop_id'=> $shop_id,'user_id'=> $user->id,'address_id'=> $request->address_id,
                    'deliveryfee' => $shipping['amount'],'deliverer'=> $shipping['by'],'expected_at'=> $shipping['hours'] ? now()->addHours($shipping['hours']) : null
                ]);
                if($shipping['by'] == 'admin'){
                    $shipment = Shipment::create(['address_id'=> $address->id,'rate_id'=> $shipping['rate_id'],'order_id'=> $order->id,'amount'=> $shipping['amount']]); 
                } 
                foreach($carts->where('shop_id',$shop_id) as $cart){
                    $order_item = OrderItem::create(['order_id'=> $order->id,'product_id'=> $cart->product_id,'quantity'=> $cart->quantity,'amount'=> $cart->amount,'total'=> $cart->total]);
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
    
    public function messages(Order $order){
        $user = auth()->user();
        OrderMessage::where('order_id',$order->id)->where('receiver_id',$user->id)->where('receiver_type','App\Models\user')->whereNull('read_at')->update(['read_at'=>now()]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Messages',
            'data' => OrderMessageResource::collection($order->messages),
        ], 200):
        view('customer.orders.messages',compact('order'));
    }
    
    public function message(Request $request){
        $order = Order::find($request->order_id);
        $message = OrderMessage::create(['order_id'=> $order->id,'sender_id'=> $request->sender_id,'sender_type'=>'App\Models\User','receiver_id'=> $request->receiver_id ,'receiver_type'=> $request->receiver_type, 'body'=> $request->body]);
        if($message->receiver_type == 'App\Models\User'){
            $receiver = User::find($message->receiver_id);
        }else{
            $receiver = Shop::find($message->receiver_id);
        }
        $receiver->notify(new OrderMessageNotification($message));
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Message Sent Successfully',
        ], 200) :
         redirect()->back();
    }

    public function review(Request $request){
        $review = Review::create(['product_id'=> $request->product_id,'user_id'=> auth()->id(),' rating'=> $request->rating,'comment'=> $request->comment]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Review Added Successfully',
        ], 200):
        redirect()->back()->with(['result'=> 1,'message'=> 'Review successfully added']); 
    }

    
    
}
