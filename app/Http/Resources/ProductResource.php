<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent=> => toArray($request);
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "description"=> $this->description,
            "slug"=> $this->slug,
            "shop_id"=> $this->shop_id,
            "category_id"=> $this->category_id,
            "category"=> $this->category->name,
            "tags"=> $this->tags,
            "image"=> $this->image,
            "price"=> $this->price,
            "amount"=> $this->amount,
            "stock"=> $this->stock,
            "published"=> $this->published,
            "timeline"=> $this->timeline,
            "expire_at"=> $this->expire_at,
            "status"=> $this->status,
            "approved"=> $this->approved,
            "discount30"=> $this->discount30,
            "discount60"=> $this->price,
            "discount90"=> $this->price,
            "discount120"=> $this->price,
            "created_at"=> $this->price,
            "updated_at"=> $this->price,
            
        ];
    }
}
