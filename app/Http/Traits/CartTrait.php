<?php
namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Arr;
use App\Http\Traits\OrderTrait;
use Illuminate\Support\Facades\Auth;

trait CartTrait
{
    use OrderTrait;

    protected function addToCartSession(Product $product,$quantity = 1,$update = false){
        $carts = session('carts');
        //if cart is empty then this is the first product
        if(!$carts) {
            $carts = collect();
            $cart = [
                        "id" => null,
                        "product_id" => $product->id,
                        "name"=> $product->name,
                        "description"=> $product->description,
                        "url"=> route('product.show',$product),
                        "shop_id"=> $product->shop_id,
                        "shop_name"=> $product->shop->name,
                        "tags"=> $product->tags,
                        "image"=> $product->image,
                        "stock"=> $product->stock,
                        "price"=> $product->price,
                        "discount"=> $product->discount,
                        'amount' => $product->amount,
                        'quantity' => abs($quantity),
                        'total' => $product->amount * abs($quantity),
                        'currency'=> $product->shop->country->currency->symbol,
                ];
            $carts = $carts->push($cart);
            session(['carts' => $carts]);
        }elseif($carts->firstWhere('product_id',$product->id)) {
                // if cart not empty then check if this product exist then increment quantity
                if($update){
                    $carts = $carts->map(function ($item, $key) use($product,$quantity){
                        if($item['product_id'] == $product->id) {
                            $item['quantity'] = abs($quantity);
                            $item['total'] = $product->amount * abs($quantity);
                        }
                        return $item;
                    });
                }     
                else{
                    $carts = $carts->map(function ($item, $key) use($product,$quantity){
                        if($item['product_id'] == $product->id) {
                            $item['quantity'] += $quantity;
                            $item['total'] = $product->amount * $item['quantity'];
                        }
                        return $item;
                    });
                }  
                session(['carts' => $carts]);
        }else{
                // if item not exist in cart then add to cart with quantity = 1
                $cart = [
                    "id" => null,
                    "product_id" => $product->id,
                    "name"=> $product->name,
                    "description"=> $product->description,
                    "url"=> route('product.show',$product),
                    "shop_id"=> $product->shop_id,
                    "shop_name"=> $product->shop->name,
                    "tags"=> $product->tags,
                    "image"=> $product->image,
                    "stock"=> $product->stock,
                    "price"=> $product->price,
                    "discount"=> $product->discount,
                    'amount' => $product->amount,
                    'quantity' => abs($quantity),
                    'total' => $product->amount * abs($quantity),
                    'currency'=> $product->shop->country->currency->symbol,
                ];
                $carts = $carts->push($cart);
                session(['carts' => $carts]); 
        }
        return $carts;
    }

    protected function removeFromCartSession(Product $product){
        $carts = session('carts');
        if($carts && $carts->count()){
            $carts = $carts->filter(function($item, $key) use($product){
                return ($item['product_id'] != $product->id);
            });
            session(['carts' => $carts]); 
        }
        return session('carts');
    }

    protected function addToCartDb(Product $product,$quantity = 1,$update = false){
        $user = Auth::user();
        $dbcart = Cart::where('user_id',$user->id)->where('product_id',$product->id)->first();
        if(!$dbcart){
            $dbcart = Cart::create(['user_id' => $user->id,'product_id' => $product->id,'shop_id'=> $product->shop_id, 'quantity' => abs($quantity), 'amount'=> $product->amount,'total'=> abs($quantity) * $product->amount]);
        }else{
            if($quantity == -1 && $dbcart->quantity == 1){
                $dbcart = Cart::where('user_id',$user->id)->where('product_id',$product->id)->delete();
            }else{
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
        }
        
    }
    
    protected function removeFromCartDb(Product $product){
        $user = Auth::user();
        $dbcart = Cart::where('user_id',$user->id)->where('product_id',$product->id)->delete();
    }
}

