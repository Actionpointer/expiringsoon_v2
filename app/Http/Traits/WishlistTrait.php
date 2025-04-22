<?php
namespace App\Http\Traits;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

trait WishlistTrait
{
    protected function addToWishlist(Product $product, ?ProductVariant $variant = null)
    {
        $user = Auth::user();
        
        // Check if product is already in wishlist
        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->when($variant, function($query) use ($variant) {
                $query->where('product_variant_id', $variant->id);
            })
            ->first();

        if (!$wishlist) {
            // Get primary image for product or variant
            $image = $product->images()
                ->when($variant, function($query) use ($variant) {
                    $query->where('product_variant_id', $variant->id);
                })
                ->where(function($query) {
                    $query->whereNull('product_variant_id')
                          ->where('is_primary', true);
                })
                ->orderBy('product_variant_id', 'desc')
                ->orderBy('is_primary', 'desc')
                ->first();

            // Create variant snapshot if variant exists
            $variantSnapshot = null;
            if ($variant) {
                $variantSnapshot = [
                    "variant_name" => $variant->name,
                    "sku" => $variant->sku,
                    "options" => $variant->options,
                    "price_at_add" => $variant->price,
                    "added_at" => now()->format('Y-m-d H:i:s'),
                    "image" => [
                        "path" => $image ? $image->image_path : null,
                        "thumbnail" => $image ? $image->thumbnail_path : null,
                        "alt_text" => $image ? $image->alt_text : ($variant ? $variant->name : $product->name)
                    ]
                ];
            }

            $wishlist = Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'product_variant_id' => $variant ? $variant->id : null,
                'variant_snapshot' => $variantSnapshot,
                'price_change_notification' => true,
                'quantity_level_notification' => $variant ? $variant->stock : null
            ]);
        }

        return $this->getWishlistCount($user);
    }

    protected function removeFromWishlist(Product $product, ?ProductVariant $variant = null)
    {
        $user = Auth::user();
        
        Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->when($variant, function($query) use ($variant) {
                $query->where('product_variant_id', $variant->id);
            })
            ->delete();

        return $this->getWishlistCount($user);
    }

    protected function getWishlist()
    {
        $user = Auth::user();
        return Wishlist::with(['product', 'productVariant'])
            ->where('user_id', $user->id)
            ->get();
    }

    protected function toggleWishlist(Product $product, ?ProductVariant $variant = null)
    {
        $user = Auth::user();
        
        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->when($variant, function($query) use ($variant) {
                $query->where('product_variant_id', $variant->id);
            })
            ->exists();

        if ($exists) {
            return $this->removeFromWishlist($product, $variant);
        }

        return $this->addToWishlist($product, $variant);
    }

    protected function updateWishlistNotifications(
        Product $product, 
        ?ProductVariant $variant = null,
        bool $priceNotification = true,
        ?int $quantityNotification = null
    ) {
        $user = Auth::user();
        
        return Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->when($variant, function($query) use ($variant) {
                $query->where('product_variant_id', $variant->id);
            })
            ->update([
                'price_change_notification' => $priceNotification,
                'quantity_level_notification' => $quantityNotification
            ]);
    }

    private function getWishlistCount($user)
    {
        return Wishlist::where('user_id', $user->id)->count();
    }
}

