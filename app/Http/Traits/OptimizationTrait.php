<?php
namespace App\Http\Traits;

use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Http\Traits\CartTrait;
use Intervention\Image\Facades\Image;


trait OptimizationTrait
{
    use CartTrait;
    
    protected function resetStores(User $user) {
        $allowed_stores = $user->max_stores;
        Store::where('user_id',$user->id)->update(['show'=> false]);
        Store::where('user_id',$user->id)->where('approved',true)->orderBy('created_at','asc')->take($allowed_stores)->update(['show'=> true]);
    }

    protected function resetProducts(User $user) {
        $allowed_products = $user->max_products;
        Product::whereIn('store_id',$user->stores->pluck('id')->toArray())->update(['show'=> false]);
        Product::whereIn('store_id',$user->stores->pluck('id')->toArray())->where('approved',true)->orderBy('created_at','desc')->take($allowed_products)->update(['show'=> true]);
    }

    protected function decreaseProducts(Order $order){
        foreach($order->items as $item){
            $item->product->stock -= $item->quantity;
            $item->product->save();
        }
    }

    protected function increaseProducts(Order $order){
        foreach($order->items as $item){
            $item->product->stock += $item->quantity;
            $item->product->save();
        }
    }

    public function adjustCart(Order $order)
    {
        foreach($order->items as $item){
            $product = $item->product;
            $cart = $this->removeFromCartSession($product);
            $this->removeFromCartDb($product);
        }
    }

    public function imageUpload($image){
        $photo = 'uploads/'.time().'.'.$image->getClientOriginalExtension();
        $path = storage_path('app/public/'.$photo);
        $imgFile = Image::make($image);
        // $imgFile->fit(150,150)->save($path);
        $imgFile->resize(null, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);
       return $photo;
    }

    public function imageFromUrl($url){
        $size = @getimagesize($url);
        if(!$size) return null;
        $extension = image_type_to_extension($size[2]);
        $banner = 'uploads/'.time().$extension;
        $path = storage_path('app/public/'.$banner);  
        $file = file_get_contents($url);
        if(!$file) return null;
        $imgFile = Image::make($file);
        $imgFile->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);
        return $banner;
        
    }
}