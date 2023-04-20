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
                "id"=> $this->product_id,
                "name"=> $this->product->name,
                "description"=> $this->product->description,
                "shop_id"=> $this->shop_id,
                "shop_name"=> $this->shop->name,
                "tags"=> $this->tags,
                "image"=> $this->image,
                "price"=> $this->product->price,
                'currency'=> $this->shop->country->currency->symbol,
                "stock"=> $this->product->stock,
                "discount"=> $this->product->discount,
                'quantity' => $this->quantity,
                'amount' => $this->product->amount,
                'total' => $this->product->amount * $this->quantity,
        ];
    }
}
