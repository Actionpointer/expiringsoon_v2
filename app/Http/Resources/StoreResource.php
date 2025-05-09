<?php

namespace App\Http\Resources;

use App\Models\Order;

use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = Auth::user();
        // return parent::toArray($request);
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "email"=> $this->email,
            "phone"=> $this->phone,
            "image"=> $this->image,
            "address"=> $this->address,
            "city"=> $this->city ? $this->city->name : '',
            "state"=> $this->state->name,
            "country"=> $this->country->name,
            "currency"=> $this->currency,
            "currency_symbol"=> $this->currency_symbol,
            "wallet"=> $this->wallet->balance,
            "status"=> $this->status,
            "approved"=> $this->approved,
            "total_products"=> $this->products->count(),
            "opened_orders"=> Order::where('store_id',$this->id)
                ->whereNull('cancelled_at')
                ->whereNull('accepted_at')
                ->whereNull('completed_at')
                ->count(),
            "total_orders"=> Order::where('store_id',$this->id)->count(),
            "is_following"=> $request->user('sanctum') ? ($request->user('sanctum')->following->firstWhere('id',$this->id) ? true:false) : null
        ];
    }
}
