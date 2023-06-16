<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsetResource extends JsonResource
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
            'plan_name' => $this->adplan->name,
            'slug' => $this->slug,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'units' => $this->units,
            'active' => $this->active,
            'status' => $this->status,
            'amount' => $this->amount,
            'ad_count' => $this->adverts->count(),
            'auto_renew' => $this->auto_renew,
            'created_at'=> $this->created_at
        ];
    }
}
