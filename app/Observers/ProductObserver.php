<?php

namespace App\Observers;

use App\Models\Product;
use App\Events\DeleteProduct;
use App\Http\Traits\OptimizationTrait;
use App\Jobs\TagUpdateJob;

class ProductObserver
{
    use OptimizationTrait;
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        if($product->published){
            Product::where('id',$product->id)->update([
                'approved'=> cache('settings')['auto_approve_product'],'show'=> $product->shop->user->max_products >= $product->shop->user->total_products ? true:false,'published' => $product->publishable]);
        }
        TagUpdateJob::dispatchIf($product->tags,$product->tags)->delay(now()->addMinutes(10));
    }

    public function updated(Product $product)
    {
        if($product->wasChanged('published') && $product->published){
            Product::where('id',$product->id)->update([
                'approved'=> cache('settings')['auto_approve_product'],'show'=> $product->shop->user->max_products >= $product->shop->user->total_products ? true:false,'published' => $product->publishable]);
        }
        TagUpdateJob::dispatchIf($product->tags,$product->tags)->delay(now()->addMinutes(10));
    }


    public function deleting(Product $product)
    {
        event(new DeleteProduct($product));
    }

    public function deleted(Product $product)
    {
        $this->resetProducts($product->shop->user);
    }

    public function restored(Product $product)
    {
        //
    }

    public function forceDeleted(Product $product)
    {
        //
    }

}
