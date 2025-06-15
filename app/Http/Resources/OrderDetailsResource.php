<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Http\Traits\OrderTrait;
use App\Http\Resources\OrderItemsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    use OrderTrait;
    
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
            
            'slug' => $this->slug,
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'store_id' => $this->store_id,
            'store_name' => $this->store->name,
            'store_image' => $this->store->image,
            'address_id' => $this->address_id,
            'address' => $this->address_id && $this->address ? $this->address->street.' '.($this->address->city ? $this->address->city->name:'').' '.($this->address->state ? $this->address->state->name:'') : '',
            'contact_name' => $this->address_id && $this->address ? $this->address->contact_name : '',
            'contact_phone' => $this->address_id && $this->address ? $this->address->contact_phone : '',
            'deliverer' => $this->deliverer,
            'expected_at' => $this->expected_at,
            'deliveryfee' => $this->delivery_fee,
            'vat' => $this->vat,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'currency'=> $this->store->country->currency->symbol,
            'status'=> $this->status,
            "statuses"=> auth()->user()->role->name == 'storeper' ? $this->getCustomerOrderStatuses(Order::find($this->id)) : $this->getVendorOrderStatuses(Order::find($this->id)),
            'created_at'=> $this->created_at,
            'items_count' => $this->items->count(),
            'items' => OrderItemsResource::collection($this->items),
        ];
    }
}
