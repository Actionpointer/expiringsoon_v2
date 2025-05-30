<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\OrderStatus;
use App\Http\Resources\UserResource;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreDetailsResource extends JsonResource
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
            "user_id"=> $this->user_id,
            "user_name"=> $this->user->name,
            "user_image"=> $this->user->image,
            "slug"=> $this->slug,
            "url"=> route('vendor.show',$this->slug),
            "name"=> $this->name,
            "description"=> $this->description,
            "email"=> $this->email,
            "phone"=> $this->phone,
            "prefix"=> $this->country->dial,
            "mobile"=> $this->mobile,
            "image"=> $this->image,
            "address"=> $this->address,
            "city_id"=> $this->city_id,
            "city"=> $this->city ? $this->city->name : '',
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
            "verified"=> $this->verified(),
            "wallet"=> $this->wallet,
            "unavailable_balance"=> $this->orders->filter(function($value){
                                        return $value->statuses->count() && $value->statuses->whereNotIn('name',['completed','cancellled'])->count();
                                    })->sum('subtotal'),
            "currency"=> $this->country->currency->symbol,
            "total_products"=> $this->products->count(),
            "opened_orders"=> OrderStatus::whereIn('order_id',$this->orders->pluck('id')->toArray())->whereNotIn('name',['completed','closed'])->count(),
            "total_orders"=> OrderStatus::whereIn('order_id',$this->orders->pluck('id')->toArray())->count(),
            "is_following"=> $request->user('sanctum') ? ($request->user('sanctum')->following->firstWhere('id',$this->id) ? true:false) : null

        ];
    }
}
