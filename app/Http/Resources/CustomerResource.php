<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            "fname"=> $this->fname,
            "lname"=> $this->lname,
            'email' => $this->email,
            'image' => $this->image,
            "role"=> $this->role,
            "slug"=> $this->slug,
            "phone"=> $this->phone,
            "prefix"=> $this->country->dial,
            "mobile"=> $this->mobile,
            "country_id"=> $this->country_id,
            "country_name"=> $this->country->name,
            "state_id"=> $this->state_id,
            "state_name"=> $this->state->name,
            "status"=> $this->status,
            "recent_orders"=> OrderResource::collection(Order::where('user_id',$this->id)->get()),
            'payment_gateway'=> $this->country->payment_gateway,            
            'payout_gateway'=> $this->country->payout_gateway,
        ];
    }
}
