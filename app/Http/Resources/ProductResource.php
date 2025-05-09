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
            // return parent::toArray($request);
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "description"=> $this->description,
            "store_name"=> $this->store->name,
            "slug"=> $this->slug,
            "image"=> $this->image,
            'currency'=> $this->store->country->currency->symbol,
            "price"=> $this->price,
            "amount"=> $this->amount,
            "stock"=> $this->stock,
            "discount"=> $this->discount,
            "expire_at"=> $this->expire_at,
            "status"=> $this->status,
            "fault" => $this->fault,
            "approved"=> $this->approved,
            "valid"=> $this->valid,
        ];
    }
}
