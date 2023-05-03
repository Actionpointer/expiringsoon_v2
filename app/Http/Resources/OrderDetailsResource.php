<?php

namespace App\Http\Resources;

use App\Http\Resources\ReviewResource;
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
            'product_image' => $this->product->image,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'total' => $this->total,
            'created_at'=> $this->created_at,
            "review" => new ReviewResource($this->product->reviews->firstWhere('user_id',$this->order->user_id))
        ];
    }
}
