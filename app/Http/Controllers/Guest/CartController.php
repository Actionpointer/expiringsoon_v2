<?php

namespace App\Http\Controllers\Guest;

use App\Models\Cart;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\WishlistTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;


class CartController extends Controller
{
    use CartTrait,WishlistTrait,PaymentTrait;
    
    public function __construct(){
        $this->middleware('auth')->only(['wishlist','addtowish','removefromwish']);
    }

    public function cart(){
        $shops = collect([]);
        $items = null;
        if(session('carts')){
            $items = session('carts');
            if($items->count()){
                $shop_ids = $items->pluck('shop_id')->toArray();
                $shops = Shop::whereIn('id',$shop_ids)->get();
            }
        }elseif($user = auth()->user()){
            $items = $user->carts;
            if($items->isNotEmpty()){
                $shop_ids = $items->pluck('shop_id')->toArray();
                $shops = Shop::whereIn('id',$shop_ids)->get();
            }
        }
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $items->count() ? 'Cart retrieved Successfully':'No item in cart',
                'data' => CartResource::collection($items),
                'count' => $items->count() ?? 0
            ], 200) :
            view('frontend.cart',compact('items','shops'));
    }

    public function addtocart(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $quantity = $request->quantity ? $request->quantity : 1;
        $update = $request->update ? true: false;
        $carts = $this->addToCartSession($product,$quantity,$update);
        if(auth()->check()){
            $this->addToCartDb($product,$quantity,$update);
            $carts = auth()->user()->carts;
        }
        return in_array('web',request()->route()->middleware()) ?
            response()->json([
                'status' => true,
                'message' => $carts->count() ? 'Cart retrieved Successfully':'No item in cart',
                'data' => $carts,
                'count' => $carts->count() ?? 0
            ], 200):
            response()->json([
                'status' => true,
                'message' => $carts->count() ? 'Cart retrieved Successfully':'No item in cart',
                'data' => CartResource::collection($carts),
                'count' => $carts->count() ?? 0
            ], 200);
        
    }

    public function removefromcart(Request $request){
        $product = Product::find($request->product_id);
        if(!$product)
        abort(404);
        $carts = $this->removeFromCartSession($product);
        if($user = auth()->user()){
            $this->removeFromCartDb($product);
            $carts = $user->carts;
        }
        
        return in_array('web',request()->route()->middleware()) ?
            response()->json([
                'status' => true,
                'message' => $carts->count() ? 'Cart retrieved Successfully':'No item in cart',
                'data' => $carts,
                'count' => $carts->count() ?? 0
            ], 200):
            response()->json([
                'status' => true,
                'message' => $carts->count() ? 'Cart retrieved Successfully':'No item in cart',
                'data' => CartResource::collection($carts),
                'count' => $carts->count() ?? 0
            ], 200);
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
