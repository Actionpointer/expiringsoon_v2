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
        // return parent::toArray($request);
        "plan": {
            "id": 1,
            "name": "Free Plan",
            "slug": "free_plan",
            "description": "Basic",
            "shops": 1,
            "products": 3,
            "months_1": 0,
            "months_3": 0,
            "months_6": 0,
            "months_12": 0,
            "commission_percentage": 15,
            "commission_fixed": 100,
            "minimum_payout": 1000,
            "maximum_payout": 100000,
            
        }
    }
}
