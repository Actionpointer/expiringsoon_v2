<?php
namespace App\Http\Traits;
use App\Models\Product;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

trait WishlistTrait
{
    protected function addWishlist(Product $product){
        $user = Auth::user();
        $wishlist = Like::firstOrCreate(['user_id' => $user->id,'product_id' => $product->id]);
        return $user->likes->count();

    }
    protected function removeWishlist(Product $product){
        $user = Auth::user();
        $wishlist = Like::where('user_id',$user->id)->where('product_id',$product->id)->delete();
        return $user->likes->count();
    }
    
}

