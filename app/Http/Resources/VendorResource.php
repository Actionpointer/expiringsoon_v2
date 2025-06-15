<?php

namespace App\Http\Resources;

use App\Models\store;
use App\Models\Order;
use App\Models\Subscription;
use App\Http\Resources\StoreResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
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
            "email_verified_at"=> $this->email_verified_at,
            'image' => $this->image,
            "store_id"=> $this->store_id,
            "role"=> $this->role->name,
            "phone"=> $this->phone,
            "prefix"=> $this->country->dial,
            "country_id"=> $this->country_id,
            "country_name"=> $this->country->name,
            "state_id"=> $this->state_id,
            "state_name"=> $this->state->name,
            "status"=> $this->status,
            "pin"=> $this->pin? true:false,
            "created_at"=> $this->created_at,
            "balance"=> $this->when($this->role->name == 'vendor', $this->stores->sum('wallet')),
            "currency"=> $this->country->currency->symbol,
            'max_products' => $this->when($this->role->name == 'vendor', $this->max_products),
            'total_products' => $this->when($this->role->name == 'vendor', $this->total_products),
            'total_stores' => $this->when($this->role->name == 'vendor', $this->total_stores),
            'max_stores' => $this->when($this->role->name == 'vendor', $this->max_stores),
            "subscription"=> $this->subscription ? new SubscriptionResource($this->subscription) :null,
            "store"=> $this->when($this->store_id, function(){ 
                return new StoreResource(store::findOrFail($this->store_id)); 
            }),
            "opened_orders"=> $this->when(!$this->store_id, function(){
                return Order::whereIn('store_id',$this->stores->pluck('id')->toArray())->take(10)->count();
            }),
            "adverts_running"=> $this->adverts->where('running',true)->count(),
            'payout_account'=> $this->payout_account ? true:false,            
            'minimum_payout'=> $this->when(!$this->store_id, function(){ 
                return $this->minimum_payout();
            }),
            'maximum_payout'=> $this->when(!$this->store_id, function(){ 
                return $this->maximum_payout();
            }),
            'changed_password'=> $this->when($this->store_id, function(){ 
                return !$this->require_password_change;
            }),
            // "recent_stores_orders"=> $this->when(!$this->store_id, function(){
            //     return OrderResource::collection(Order::whereIn('store_id',$this->stores->pluck('id')->toArray())->take(10)->get());

            // }),
            
            
        ];
    }
}
