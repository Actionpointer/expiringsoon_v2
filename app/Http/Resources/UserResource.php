<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "firstname"=> $this->firstname,
            "surname"=> $this->surname,
            'email' => $this->email,
            "email_verified_at"=> $this->email_verified_at,
            'image' => $this->image,
            "phone"=> $this->phone,
            "mobile"=> $this->mobile,
            "country_id"=> $this->country_id,
            "country_name"=> $this->country->name,
            "status"=> $this->status,
            "shops"=> $this->shops->pluck('id')->combine($this->shops->pluck('name')),
        ];
    }
}
