<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductDetailsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedResource extends JsonResource
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
            'state' => $this->state->name,
            'views' => $this->views,
            'clicks' => $this->clicks,
            'status' => $this->status,
            'running' => $this->running,
            'approved' => $this->approved,
            'created_at'=> $this->created_at,
            'product' => new ProductDetailsResource($this->product)
        ];
        
    }
}
