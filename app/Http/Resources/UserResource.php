<?php

namespace App\Http\Resources;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Subscription;
use App\Http\Resources\ShopResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\SubscriptionResource;
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
            "fname"=> $this->fname,
            "lname"=> $this->lname,
            'email' => $this->email,
            "email_verified_at"=> $this->email_verified_at,
            'image' => $this->image,
            "shop_id"=> $this->shop_id,
            "role"=> $this->role->name,
            "phone"=> $this->phone,
            "prefix"=> $this->country->dial,
            "country_id"=> $this->country_id,
            "country_name"=> $this->country->name,
            "state_id"=> $this->state_id,
            "state_name"=> $this->state->name,
            "state_name"=> $this->state->name,
            "status"=> $this->status,
            "pin"=> $this->pin? true:false,
            "created_at"=> $this->created_at,
            "balance"=> $this->when($this->role->name == 'vendor', $this->shops->sum('wallet')),
            "currency"=> $this->country->currency->symbol,
            'max_products' => $this->when($this->role->name == 'vendor', $this->max_products),
            'total_products' => $this->when($this->role->name == 'vendor', $this->total_products),
            'total_shops' => $this->when($this->role->name == 'vendor', $this->total_shops),
            'max_shops' => $this->when($this->role->name == 'vendor', $this->max_shops),
            "subscription"=> $this->subscription_id ? new SubscriptionResource(Subscription::findOrFail($this->subscription_id)) :null,
            // "shops"=> $this->when(!$this->shop_id, ShopResource::collection(Shop::where('user_id',$this->id)->get())),
            "shop"=> $this->when($this->shop_id, function(){ 
                return new ShopResource(Shop::findOrFail($this->shop_id)); 
            }),
            "opened_orders"=> $this->when(!$this->shop_id, function(){
                return Order::whereIn('shop_id',$this->shops->pluck('id')->toArray())->take(10)->count();
            }),
            "adverts_running"=> $this->adverts->where('running',true)->count(),
            'payment_gateway'=> $this->country->payment_gateway,            
            'payout_gateway'=> $this->country->payout_gateway,
            'minimum_payout'=> $this->when(!$this->shop_id, function(){ 
                return $this->minimum_payout();
            }),
            'maximum_payout'=> $this->when(!$this->shop_id, function(){ 
                return $this->maximum_payout();
            }),
            'changed_password'=> $this->when($this->shop_id, function(){ 
                return !$this->require_password_change;
            }),
            // "recent_shops_orders"=> $this->when(!$this->shop_id, function(){
            //     return OrderResource::collection(Order::whereIn('shop_id',$this->shops->pluck('id')->toArray())->take(10)->get());
            // }),
            
            
        ];
    }
}
