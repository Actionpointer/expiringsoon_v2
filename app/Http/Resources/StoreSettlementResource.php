<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreSettlementResource extends JsonResource
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
            "amount"=> $this->amount,
            "currency"=> auth()->user()->country->currency->symbol,
            "order_id"=> $this->order->slug,
            "created_at"=> $this->created_at,   
        ];
    }
}
