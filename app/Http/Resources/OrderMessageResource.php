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
            'sender_name' => $this->sender_type == 'App\Models\User' ? $this->order->user->name :$this->order->store->name,
            'sender_type' => $this->sender_type == 'App\Models\User' ? 'user' :'store',
            'body' => $this->body,
            'attachment' => $this->file,
            'created_at'=> $this->created_at
        ];
    }
}
