<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent=>=>toArray($request);
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "slug"=> $this->slug,
            "description"=> $this->description,
            "stores"=> $this->stores,
            "products"=> $this->products,
            "months_1"=> $this->months_1,
            "months_3"=> $this->months_3,
            "months_6"=> $this->months_6,
            "months_12"=> $this->months_12,
            "commission_percentage"=> $this->commission_percentage,
            "commission_fixed"=> $this->commission_fixed,
            "minimum_payout"=> $this->minimum_payout,
            "maximum_payout"=> $this->maximum_payout,
            "currency"=> auth()->user()->country->currency->symbol
        ];
    }
}
