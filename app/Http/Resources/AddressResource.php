<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            "state_id" => $this->state_id,
            "state" => $this->state->name,
            "city" => $this->city->name,
            "city_id" => $this->city_id,
            "postal_code" => $this->postal_code,
            "street" => $this->street,
            "contact_phone" => $this->contact_phone,
            'contact_name'=> $this->contact_name,
            "main" => $this->main,
            
        ];
    }
}
