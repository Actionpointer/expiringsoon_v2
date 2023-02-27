<?php

namespace App\Http\Controllers\Guest;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\WishlistTrait;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    use CartTrait,WishlistTrait,PaymentTrait;
    
    public function __construct(){
        $this->middleware('auth')->only(['wishlist','addtowish','removefromwish','checkout','confirmcheckout']);
    }

    public function cart(){
        $items = session('cart');
        $shops = collect([]);
        if($items && count($items)){
            $shop_ids = array_column($items, 'shop_id');
            $shops = Shop::whereIn('id',$shop_ids)->get();
        }
        return view('frontend.cart',compact('items','shops'));
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

    

}
