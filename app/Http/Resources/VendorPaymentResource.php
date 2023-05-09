<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorPaymentResource extends JsonResource
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
            'id'=> $this->id,
            'item' => $this->items->first()->paymentable_type == 'App\Models\Subscription' ? 'Subscription' : 'Adset ',
            'user_id' => $this->user_id,
            'currency'=> $this->currency->symbol,
            'amount' => $this->amount,
            'reference' => $this->reference,
            'created_at' => $this->created_at,
        ];
    }
}
