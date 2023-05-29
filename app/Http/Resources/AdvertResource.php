<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertResource extends JsonResource
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
            
            'id' => $this->id,
            'image' => $this->image,
            'state' => $this->state->name,
            'views' => $this->views,
            'clicks' => $this->clicks,
            'status' => $this->status,
            'running' => $this->running,
            'approved' => $this->approved,
            'created_at'=> $this->created_at,
            'item_type' => str_replace('App\Models\\','',$this->advertable_type),
            'item' => $this->advertable
        ];
    }
}
