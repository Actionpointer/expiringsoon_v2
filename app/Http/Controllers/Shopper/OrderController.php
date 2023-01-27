<?php

namespace App\Http\Controllers\Shopper;

use App\Models\Cart;
use App\Models\City;
use App\Models\Shop;
use App\Models\Order;
use App\Models\State;
use App\Models\Review;
use App\Models\Address;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use App\Models\OrderMessage;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\WishlistTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    use CartTrait,WishlistTrait,PaymentTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = auth()->user();
        return view('customer.orders.list',compact('user'));
    }
    
    public function show(Order $order){
        $user = auth()->user();
        OrderMessage::where('order_id',$order->id)->where('user_id',$user->id)->where('receiver',$user->role)->whereNull('read_at')->update(['read_at'=>now()]);
        return view('order',compact('order'));
    }

    public function wishlist(){
        $user = auth()->user();
        return view('customer.wishlist',compact('user'));
    }

    public function transactions(){
        $payments = Payment::where('user_id',auth()->id())->where('status','success')->get();
        return view('customer.payments',compact('payments'));
    }

    public function checkout(Shop $shop = null){
        
        $user = auth()->user();
        
        $items = request()->session()->get('cart');
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
        $carts = $carts->whereIn('product_id',array_keys($items))->get();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $order = $this->getOrder($carts);
        $rates = ShippingRate::whereNull('shop_id')->orWhereIn('shop_id',$carts->pluck('shop_id')->toArray())->get();
        return view('frontend.checkout',compact('carts','user','countries','states','cities','order','rates'));
    }

    public function shipment(Request $request){
        $carts = $request->carts;
        $address_id = $request->address_id;
        return response()->json($this->getEachShipment($carts,$address_id),200);
    }

    public function confirmcheckout(Request $request){
        try{
            $user = auth()->user();
            $carts = Cart::whereIn('id',$request->carts)->get();
            $vat = $user->country->vat;
            $address = Address::find($request->address_id);
            $orders = collect([]);
            foreach($carts->pluck('shop_id')->unique()->toArray() as $shop_id){
                $subtotal = 0;
                $shipping_fee = 0;
                $shipping_hours = null;
                if($request->shop_delivery[$shop_id]){
                    $shipping_fee = $this->getShopShipment($shop_id,$address->state_id)['amount'];
                    $shipping_hours = $this->getShopShipment($shop_id,$address->state_id)['hours'];
                }
                //dd($shipping_fee);
                $order = Order::create(['shop_id'=> $shop_id,'user_id'=> $user->id,'address_id'=> $request->address_id,
                    'deliveryfee'=> $shipping_fee,'expected_at'=> $shipping_hours ? now()->addHours($shipping_hours) : null
                ]);
                foreach($carts->where('shop_id',$shop_id) as $cart){
                    $cart->order_id = $order->id;
                    $cart->save();
                    $subtotal += $cart->total;
                }
                $order->subtotal = $subtotal;
                $order->vat = $vat * $subtotal / 100;
                $order->total = ($vat * $subtotal / 100) + $subtotal + $shipping_fee;
                $order->save();
                $orders->push($order);
            }
            //take payment
            $link = $this->initializePayment($orders->sum('total'),$orders->pluck('id')->toArray(),'App\Models\Order');
            return redirect()->to($link); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function message(Request $request){
        $order = Order::find($request->order_id);
        $message = OrderMessage::create(['user_id'=> $order->user_id,'order_id'=> $order->id,'shop_id'=> $order->shop_id,'body'=> $request->body,'sender'=> $request->sender,'receiver' => $request->receiver]);
        return redirect()->back();
    }

    public function review(Request $request){
        // dd($request->all());
        if($request->shop_id){
            $review = Review::create(['reviewable_id'=> $request->shop_id,'reviewable_type'=> 'App\Models\Shop','order_id'=> $request->order_id,' rating'=> $request->rating,'comment'=> $request->comment]);
        }else{
            $review = Review::create(['reviewable_id'=> $request->product_id,'reviewable_type'=> 'App\Models\Product','order_id'=> $request->order_id,' rating'=> $request->rating,'comment'=> $request->comment]);
        }
        return redirect()->back()->with(['result'=> 1,'message'=> 'Review successfully added']);
    }

    
    
}
