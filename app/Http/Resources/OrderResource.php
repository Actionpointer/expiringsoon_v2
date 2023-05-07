<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'slug' => $this->slug,
            'user_id' => $this->user_id,
            'shop_id' => $this->shop_id,
            'shop_name' => $this->shop->name,
            'shop_image' => $this->shop->image,
            'expected_at' => $this->expected_at,
            'total' => $this->total,
            'currency' => $this->shop->country->currency->symbol,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'items' => $this->items->count()
        ];
    }
}
