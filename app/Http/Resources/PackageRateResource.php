<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     "id"=> $this->id,
        //     "name"=> $this->name,
        //     "image"=> $this->slug,
        //     "description"=> $this->description,
        //     "amount"=> $this->rates->where('shop_id'),
        //     "currency"=> auth()->user()->country->currency->symbol
        // ];
    }
}
