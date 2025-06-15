<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'name'=> $this->name,
            'code'=> $this->code,
            'continent'=> $this->continent, 
            'dial'=> $this->dial, 
            'currency_name'=> $this->currency->name,
            'currency_code'=> $this->currency->code, 
            'currency_symbol'=> $this->currency->symbol,
            'currency_decimal_places'=> $this->currency->decimal_places, 
            'status' => $this->status,
        ];
    }
}
