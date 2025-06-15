<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "firstname"=> $this->firstname,
            "surname"=> $this->surname,
            'email' => $this->email,
            'image' => $this->image,
            "phone"=> $this->phone,
            "prefix"=> $this->country->dial,
            "phone"=> $this->phone,
            "country_id"=> $this->country_id,
            "country_name"=> $this->country->name,
            
            "status"=> $this->status,
            // "recent_orders"=> OrderResource::collection(Order::where('user_id',$this->id)->whereHas('statuses')->get()),
            // 'payment_gateway'=> $this->country->payment_gateway,            
            // 'payout_gateway'=> $this->country->payout_gateway,
            'currency'=> $this->country->currency->symbol,
            'cart'=> $this->carts->pluck('product_id')->combine($this->carts->pluck('quantity')),
            'wishlist' => $this->likes->pluck('product_id')->toArray(),
            'stores' => $this->stores->pluck('id'),
            "created_at" => $this->created_at
        ];
    }
}
