<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Product;
use App\Http\Resources\UserResource;
use App\Http\Resources\ProductResource;
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
            "user_id"=> $this->user_id,
            "slug"=> $this->slug,
            "name"=> $this->name,
            "description"=> $this->description,
            "email"=> $this->email,
            "phone"=> $this->phone,
            "prefix"=> $this->country->dial,
            "mobile"=> $this->mobile,
            "image"=> $this->image,
            "address"=> $this->address,
            "city_id"=> $this->city_id,
            "city"=> $this->city->name,
            "state_id"=> $this->state_id,
            "state"=> $this->state->name,
            "country_id"=> $this->country_id,
            "country"=> $this->country->name,
            "discount30"=> $this->discount30,
            "discount60"=> $this->discount60,
            "discount90"=> $this->discount90,
            "discount120"=> $this->discount120,
            "status"=> $this->status,
            "approved"=> $this->approved,
            "published"=> $this->published,
            "verified"=> $this->verified,
            "certified"=> $this->certified,
            "wallet"=> $this->wallet,
            "currency"=> $this->country->currency->symbol,
            "total_products"=> $this->products->count(),
            "opened_orders"=> $this->orders->whereNotIn('status',['completed','cancelled'])->count(),
            "total_orders"=> $this->orders->count(),
            // "staff" => UserResource::collection(User::where('shop_id',$this->id)->get())
        ];
    }
}
