<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'subject' => $this->data->subject,
            'body' => $this->data->body,
            'url' => $this->data->url,
            'created_at' => $this->created_at,
            'read_at' => $this->read_at,
        ];
    }
}
