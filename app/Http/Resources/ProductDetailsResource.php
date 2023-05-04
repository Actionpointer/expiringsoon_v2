<?php

namespace App\Http\Resources;

use App\Http\Resources\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "description"=> $this->description,
            "slug"=> $this->slug,
            "url"=> route('product.show',$this->slug),
            "shop_id"=> $this->shop_id,
            "shop_name"=> $this->shop->name,
            "shop_image"=> $this->shop->image,
            "category_id"=> $this->category_id,
            "category"=> $this->category->name,
            "tags"=> $this->tags,
            "image"=> $this->image,
            'currency'=> $this->shop->country->currency->symbol,
            "price"=> $this->price,
            "amount"=> $this->amount,
            "stock"=> $this->stock,
            "published"=> $this->published,
            "expire_at"=> $this->expire_at,
            "status"=> $this->status,
            "approved"=> $this->approved,
            "valid"=> $this->valid,
            "available"=> $this->available,
            "accessible"=> $this->accessible(),
            "certified"=> $this->certified(),
            "discount"=> $this->discount,
            "timeline"=> $this->timeline,
            "discount30"=> $this->discount30,
            "discount60"=> $this->discount60,
            "discount90"=> $this->discount90,
            "discount120"=> $this->discount120,
            'rating' => $this->ratings(),
            'reviewable'=> $this->reviewable(),
            "reviews" => ReviewResource::collection($this->reviews->sortByDesc('rating')->take(3)),
            "expected_hours"=> cache('settings')['order_processing_to_delivery_period'],
            "refund_hours" => cache('settings')['order_processing_to_auto_cancel_period']
            
        ];
    }
}
