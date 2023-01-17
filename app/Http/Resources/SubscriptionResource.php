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
            "id"=> $this->id,
            "user_id"=> $this->user_id,
            "plan_id"=> $this->plan_id,
            "coupon"=> $this->coupon,
            "amount"=> $this->amount,
            "start_at"=> $this->start_at,
            "renew_at"=> $this->renew_at,
            "end_at"=> $this->end_at,
            "status"=> $this->status,
            "auto_renew"=> $this->auto_renew,
            "deleted_at"=> $this->deleted_at,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            "active"=> $this->active,
            "duration"=> $this->duration,
            "is_free"=> $this->is_free,
            "plan"=> new PlanResource(Plan::findOrFail($this->plan_id))
            
        ];
    }
}
