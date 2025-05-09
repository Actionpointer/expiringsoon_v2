<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentRateResource extends JsonResource
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
            'id'=> $this->id,
            'destination_id' => $this->destination_id,
            'destination' => $this->destination->name,
            'country' => $this->country->name,
            'currency'=> $this->country->currency->symbol,
            'amount' => $this->amount,
            'hours' => $this->hours,
            'created_at' => $this->created_at,
        ];
    }
}
