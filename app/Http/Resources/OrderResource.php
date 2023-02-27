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
            'items' => $this->items->count(),
            'slug' => $this->slug,
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'shop_id' => $this->shop_id,
            'shop_name' => $this->shop->name,
            'address_id' => $this->address_id,
            'address' => $this->address_id ? $this->address->street.' '.($this->address->city ? $this->address->city->name:'').' '.$this->address->state->name : '',
            'contact_name' => $this->address_id ? $this->address->contact_name : '',
            'contact_phone' => $this->address_id ? $this->address->contact_phone : '',
            'deliveryby' => $this->address_id ? 'Vendor':'Customer Pickup',
            'expected_at' => $this->expected_at,
            'delivered_at' => $this->delivered_at,
            'deliveryfee' => $this->delivery_fee,
            'vat' => $this->vat,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'currency'=> $this->shop->country->currency->symbol,
            'status'=> $this->status,
            'created_at'=> $this->created_at
        ];
    }
}
