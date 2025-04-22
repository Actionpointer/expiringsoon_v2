<?php
namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Arr;
use App\Http\Traits\OrderTrait;
use Illuminate\Support\Facades\Auth;

trait CartTrait
{
    use OrderTrait;

    protected function addToCart(Product $product, ProductVariant $variant, $quantity = 1, $update = false)
    {
        $user = Auth::user();
        $dbcart = Cart::where('user_id', $user->id)
                     ->where('product_id', $product->id)
                     ->where('product_variant_id', $variant->id)
                     ->first();

        // Get variant-specific image or fall back to product's primary image
        $image = $product->images()
            ->where(function($query) use ($variant) {
                $query->where('product_variant_id', $variant->id)
                      ->orWhere(function($q) {
                          $q->whereNull('product_variant_id')
                            ->where('is_primary', true);
                      });
            })
            ->orderBy('product_variant_id', 'desc') // Prefer variant images
            ->orderBy('is_primary', 'desc')
            ->first();

        $variantSnapshot = [
            "variant_name" => $variant->name,
            "sku" => $variant->sku,
            "options" => $variant->options,
            "price_at_add" => $variant->price,
            "selected_at" => now()->format('Y-m-d H:i:s'),
            "image" => [
                "path" => $image ? $image->image_path : null,
                "thumbnail" => $image ? $image->thumbnail_path : null,
                "alt_text" => $image ? $image->alt_text : $variant->name
            ]
        ];

        if(!$dbcart) {
            $dbcart = Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'product_variant_id' => $variant->id,
                'shop_id' => $product->shop_id,
                'quantity' => abs($quantity),
                'amount' => $variant->price,
                'total' => abs($quantity) * $variant->price,
                'currency_code' => $product->currency_code,
                'variant_snapshot' => $variantSnapshot
            ]);
        } else {
            if($update) {
                $dbcart->quantity = $quantity;
            } else {
                $dbcart->quantity = $dbcart->quantity + $quantity;
            }
            
            // Ensure quantity doesn't go below 0
            $dbcart->quantity = max(0, $dbcart->quantity);
            
            if($dbcart->quantity == 0) {
                $dbcart->delete();
                return null;
            }

            $dbcart->amount = $variant->price;
            $dbcart->total = $dbcart->quantity * $variant->price;
            $dbcart->variant_snapshot = $variantSnapshot;
            $dbcart->save();
        }

        return $dbcart;
    }
    
    protected function removeFromCart(Product $product, ProductVariant $variant = null)
    {
        $user = Auth::user();
        $query = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id);
        
        if ($variant) {
            $query->where('product_variant_id', $variant->id);
        }
        
        return $query->delete();
    }

    protected function getUserCart()
    {
        $user = Auth::user();
        return Cart::with(['product', 'productVariant', 'shop'])
                  ->where('user_id', $user->id)
                  ->get();
    }

    protected function validateCartItem(Product $product, ProductVariant $variant, $quantity)
    {
        // Check if product is published and approved
        if (!$product->published || !$product->approved) {
            throw new \Exception('Product is not available');
        }

        // Check if variant is active
        if (!$variant->is_active) {
            throw new \Exception('Product variant is not available');
        }

        // Check stock
        if ($variant->stock < $quantity) {
            throw new \Exception('Requested quantity not available');
        }

        // Check if product belongs to variant
        if ($variant->product_id !== $product->id) {
            throw new \Exception('Invalid product variant combination');
        }

        return true;
    }
}

