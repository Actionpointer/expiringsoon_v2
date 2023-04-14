<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdplansResource extends JsonResource
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
            "name" => $this->name,
            "description" => $this->description,
            "page" => $this->page,
            "type" => $this->type,
            "price_per_day" => $this->price_per_day,
            'currency'=> auth()->user()->country->currency->symbol,
            "days" => 0,
            "units" => 1
        ];
    }
}
