<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [

                "id"=> $this->id,
                "product_id"=> $this->product_id,
                "name"=> $this->product->name,
                "description"=> $this->product->description,
                "url"=> route('product.show',$this->product->slug),
                "tags"=> $this->product->tags,
                "image"=> $this->product->image,
                "store_id"=> $this->store_id,
                "store_name"=> $this->store->name,
                "price"=> $this->product->price,
                'currency'=> $this->store->country->currency->symbol,
                "stock"=> $this->product->stock,
                "discount"=> $this->product->discount,
                'quantity' => $this->quantity,
                'amount' => $this->product->amount,
                'total' => $this->product->amount * $this->quantity,
        ];
    }
}
