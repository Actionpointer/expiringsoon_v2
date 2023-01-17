<?php

namespace App\Http\Resources;

use App\Http\Resources\ShopResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "fname"=> $this->fname,
            "lname"=> $this->lname,
            'email' => $this->email,
            'image' => $this->image,
            "shop_id"=> $this->shop_id,
            "subscription_id"=> $this->subscription_id,
            "role"=> $this->role,
            "slug"=> $this->slug,
            "phone_prefix"=> $this->phone_prefix,
            "phone"=> $this->phone,
            "state_id"=> $this->state_id,
            "state_name"=> $this->state->name,
            "status"=> $this->status,
            "balance"=> $this->shops->sum('wallet'),
            "subscription"=> $this->subscription_id ? $this->subscription :null,
            "shops"=> $this->shop_id ? null: ShopResource::collection($this->shops),
        ];
    }
}
