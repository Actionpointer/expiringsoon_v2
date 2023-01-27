<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderMessageResource extends JsonResource
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
            'order_id' => $this->order_id,
            'sender_name' => $this->sender_type == 'App\Models\User' ? $this->user->name:$this->shop->name,
            'body' => $this->body,
            'read_at' => $this->read_at,
            'created_at'=> $this->created_at
        ];
    }
}
