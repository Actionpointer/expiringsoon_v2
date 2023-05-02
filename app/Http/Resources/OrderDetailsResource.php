<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Http\Resources\ProductResource;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'id' => $this->id,
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'product_slug' => $this->product->slug,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'total' => $this->total,
            'created_at'=> $this->created_at
        ];
    }
}
