<?php

namespace App\Http\Resources;

use App\Models\OrderStatus;

use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        // return parent::toArray($request);
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "email"=> $this->email,
            "phone"=> $this->phone,
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
            "opened_orders"=> OrderStatus::whereIn('order_id',$this->orders->pluck('id')->toArray())->whereNotIn('name',['completed','closed'])->count(),
            "total_orders"=> OrderStatus::whereIn('order_id',$this->orders->pluck('id')->toArray())->count(),
            "is_following"=> $request->user('sanctum') ? ($request->user('sanctum')->following->firstWhere('id',$this->id) ? true:false) : null
        ];
    }
}
