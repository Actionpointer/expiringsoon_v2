<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
        "subscription": {
            "id": 21,
            "user_id": 49,
            "plan_id": 1,
            "coupon": null,
            "amount": 0,
            "start_at": "2023-01-16T16:39:16.000000Z",
            "renew_at": null,
            "end_at": null,
            "status": 1,
            "auto_renew": 0,
            "deleted_at": null,
            "created_at": "2023-01-16T17:38:51.000000Z",
            "updated_at": "2023-01-16T17:38:51.000000Z",
            "active": false,
            "duration": 0,
            "is_free": true,
            
        }
    }
}
