<?php
namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Arr;
use App\Http\Traits\OrderTrait;
use Illuminate\Support\Facades\Auth;

trait CartTraitOld
{
    use OrderTrait;

    protected function addToCartSession(Product $product,$quantity = 1,$update = false){
        $cart = session('carts');
        //if cart is empty then this is the first product
        if(!$cart) {
            $cart = [
                    $product->id => [
                        "product" => $product,
                        "shop_id" => $product->shop_id,
                        "quantity" => abs($quantity),
                        "amount" => $product->amount,
                        "total" => $product->amount * abs($quantity),
                    ]
            ];
            session(['carts' => $cart]);
        }else{
            // if cart not empty then check if this product exist then increment quantity
            if(isset($cart[$product->id])) {
                if($update){
                    $cart[$product->id]['quantity'] = abs($quantity);
                    $cart[$product->id]['total'] = $product->amount * abs($quantity);
                }     
                else{
                    $cart[$product->id]['quantity'] = $cart[$product->id]['quantity'] + $quantity;
                    $cart[$product->id]['total'] = $product->amount * $cart[$product->id]['quantity'];
                }   
                session(['carts' => $cart]);
            }else{
                // if item not exist in cart then add to cart with quantity = 1
                $cart[$product->id] = [
                    "product" => $product,
                    "shop_id" => $product->shop_id,
                    "quantity" => abs($quantity),
                    "amount" => $product->amount,
                    "total" => $product->amount * abs($quantity),
                ];
                session(['carts' => $cart]);
            }
        }
        return $cart;
    }


    protected function removeFromCartSession(Product $product){
        $oldcart = session('carts');
        if($oldcart && count($oldcart)){
             $cart = Arr::except($oldcart, ["$product->id"]);
             session(['carts' => $cart]);
        }
        return session('carts');
    }

    protected function addToCartDb(Product $product,$quantity = 1,$update = false){
        $user = Auth::user();
        $dbcart = Cart::firstOrNew(['user_id' => $user->id,'product_id' => $product->id,'shop_id'=> $product->shop_id]);
        if($update){
            $dbcart->quantity = $quantity;
            $dbcart->amount = $product->amount;
            $dbcart->total = $quantity * $product->amount;
        }   
        else {
            $dbcart->quantity = $dbcart->quantity + $quantity;
            $dbcart->amount = $product->amount;
            $dbcart->total = ($dbcart->quantity + $quantity) * $product->amount;
        }
        $dbcart->save();
    }
    
    protected function removeFromCartDb(Product $product){
        $user = Auth::user();
        $dbcart = Cart::where('user_id',$user->id)->where('product_id',$product->id)->delete();
    }
}

