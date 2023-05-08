<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\OrderStatus;
use App\Http\Resources\UserResource;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            "image"=> $this->image,
            "address"=> $this->address,
            "city"=> $this->city ? $this->city->name : '',
            "state"=> $this->state->name,
            "country"=> $this->country->name,
            "status"=> $this->status,
            "approved"=> $this->approved,
            "published"=> $this->published,
            "verified"=> $this->verified(),
            "certified"=> $this->certified(),
            "wallet"=> $this->wallet,
            "currency"=> $this->country->currency->symbol,
            "total_products"=> $this->products->count(),
        ];
    }
}
