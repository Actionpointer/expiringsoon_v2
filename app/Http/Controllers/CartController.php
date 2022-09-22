<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Shop;
use App\Models\Order;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\WishlistTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    use CartTrait,WishlistTrait,PaymentTrait;
    
    public function __construct(){
        $this->middleware('auth')->only(['wishlist','addtowish','removefromwish','checkout','confirmcheckout']);
    }

    public function wishlist(){
        $user = auth()->user();
        return view('customer.wishlist',compact('user'));
    }

    public function cart(){
        $items = request()->session()->get('cart');
        $shops = collect([]);
        if($items && count($items)){
            $shop_ids = array_column($items, 'shop_id');
            $shops = Shop::whereIn('id',$shop_ids)->get();
        }
        $order = $this->getOrder();
        return view('frontend.cart',compact('items','order','shops'));
    }

    public function addtocart(Request $request){
        // $request->session()->flush();
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $quantity = $request->quantity ?? 1;
        $update = $request->update ?? false;
        $cart = $this->addToCartSession($product,$quantity,$update);
        if(auth()->check())
        $this->addToCartDb($product,$quantity,$update);
        return response()->json(['cart_count'=> count((array)$cart),'cart'=> $cart],200);
    }

    public function removefromcart(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $cart = $this->removeFromCartSession($product);
        if(auth()->check())
        $this->removeFromCartDb($product);
        return response()->json(['cart_count'=> count((array)$cart),'cart'=> $cart],200);
    }

    public function addtowish(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $wish = $this->addWishlist($product);
        return response()->json(['wish_count'=> $wish],200);
    }

    public function removefromwish(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $wish = $this->removeWishlist($product);
        return response()->json(['wish_count'=> $wish],200);
    }

    public function checkout(Request $request){
        $user = auth()->user();
        $items = request()->session()->get('cart');
        if(!isset($items)){
            return redirect()->back();
        }
        foreach($items as $key => $value){
            $this->addToCartDb($value['product'],$value['quantity'],true);
        }

        $carts = Cart::where('user_id',$user->id);
        if($request->shop_id){
            $carts = $carts->where('shop_id',$request->shop_id);
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
        // dd($request->all());
        $user = auth()->user();
        $carts = Cart::whereIn('id',$request->carts)->get();
        $vat = Setting::where('name','vat')->first()->value;
        $orders = collect([]);
        foreach($carts->pluck('shop_id')->unique()->toArray() as $shop_id){
            $subtotal = 0;
            $shipping_fee = 0;
            $shipping_hours = null;
            if($request->shop_delivery[$shop_id]){
                $shipping_fee = $this->getShopShipment($shop_id,$request->address_id)['amount'];
                $shipping_hours = $this->getShopShipment($shop_id,$request->address_id)['hours'];
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
        if(!$link)
        return 'PAGE SHOWING service unavailable right now.. ask the user to TRY AGAIN LATER';
        else
        return redirect()->to($link);
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
