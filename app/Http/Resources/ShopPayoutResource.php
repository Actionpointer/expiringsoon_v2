<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopPayoutResource extends JsonResource
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
            "channel"=> $this->channel,
            "destination"=> $this->destination,
            "status"=> $this->status,
            "created_at"=> $this->created_at,   
        ];
    }
}
