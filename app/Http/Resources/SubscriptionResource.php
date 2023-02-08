<?php

namespace App\Http\Resources;

use App\Models\Plan;
use App\Http\Resources\PlanResource;
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
        // return parent=>=>toArray($request);
        return [
            "user_id"=> $this->user_id,
            "plan_id"=> $this->plan_id,
            "plan_name"=> $this->plan->name,
            "plan_slug"=> $this->plan->slug,
            "start_at"=> $this->start_at,
            "renew_at"=> $this->renew_at,
            "end_at"=> $this->end_at,
            "status"=> $this->status,
            "auto_renew"=> $this->auto_renew,
            "active"=> $this->active,
            "duration"=> $this->duration,
            "is_free"=> $this->is_free,
            
        ];
    }
}
