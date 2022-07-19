<?php
namespace App\Http\Traits;
use App\Product;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;

trait WishlistTrait
{
    protected function addWishlist(Product $product){
        $user = Auth::user();
        $wishlist = Wishlist::firstOrCreate(['user_id' => $user->id,'product_id' => $product->id]);
        return $user->wishlists->count();

    }
    protected function removeWishlist(Product $product){
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id',$user->id)->where('product_id',$product->id)->delete();
        return $user->wishlists->count();
    }
    
}

