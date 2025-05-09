<?php

namespace App\Models;


use App\Models\Cart;
use App\Models\Like;
use App\Models\AdminPermission;
use App\Models\Store;
use App\Models\Order;
use App\Models\State;
use App\Models\Payout;
use App\Models\Account;
use App\Models\Address;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Rejection;
use App\Models\Settlement;
use App\Models\OrderMessage;
use App\Models\Subscription;
use App\Observers\UserObserver;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,HasApiTokens;

    protected $guarded = ['id'];

    protected $appends = ['image'];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot(){
        parent::boot();
        parent::observe(new UserObserver);
    }


    public function getNameAttribute(){
        return ucwords($this->firstname.' '.$this->surname);   
    }
    
    public function getMobileAttribute(){
        return $this->country->dial.intval($this->phone);   
    }

    public function getImageAttribute(){
        return $this->photo ? config('app.url')."/storage/$this->photo":null;  
    }

    public function hasPermission($permissions){
        return $this->is_admin->permissions->contains($permissions);
    }
    
    public function stores(){
        return $this->hasMany(Store::class);
    }
    

    public function products(){  
        return $this->hasManyThrough(Product::class,Store::class,'user_id','store_id');
    }
    public function storeOrders(){
        return $this->hasManyThrough(Order::class,Store::class,'user_id','store_id');
    } 
    public function adverts(){  
        return $this->hasManyThrough(Advert::class,Adset::class,'user_id','adset_id');
    }
    public function subscription(){
        return $this->hasOne(Subscription::class,'user_id');
    }

    public function getSubscriptionNameAttribute(){
        if($this->subscription){
            return $this->subscription->plan->name;
        }else return null;    
    }
    public function getTotalProductsAttribute(){
        if($this->store_id)
            return $this->store->user->products->count();
        else return $this->products->count();
    }
    public function getTotalStoresAttribute(){
        if($this->store_id)
            return $this->store->user->stores->count();
        else return $this->stores->count();
    }
    public function getMaxStoresAttribute(){
        if($this->store_id)
            return $this->store->user->subscription->plan->stores;
        elseif($this->subscription)
            return $this->subscription->plan->stores;
    }
    public function getMaxProductsAttribute(){
        if($this->store_id)
            return $this->store->user->subscription->plan->products;
        elseif($this->subscription)
             return $this->subscription->plan->products;
    }
    
    public function minimum_payout(){
        return $this->subscription->plan->minimum_payout;
        
    }
    public function maximum_payout(){
        return $this->subscription->plan->maximum_payout;
    }
    
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function orderMessages(){
        return $this->morphOne(OrderMessage::class, 'sender');
    }
      
    public function likes(){
        return $this->hasMany(Like::class);
    }
    
    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function payouts(){
        return $this->hasMany(Payout::class);
    }

    public function bankaccount(){
        return $this->hasOne(Account::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }


    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function following(){
        return $this->belongsToMany(Store::class,'followers','user_id','store_id');
    }

    public function kyc(){
        return $this->hasMany(Kyc::class);
    }
    
    public function idcard(){
        return $this->morphOne(Kyc::class,'verifiable')->where('type','idcard');
    }

    public function adsets(){
        return $this->hasMany(Adset::class);
    }

    public function activeAdsets(){
        return $this->hasMany(Adset::class)->where('end_at', '>', now())->where('status',true); 
    }

    public function settlements(){
        return $this->morphMany(Settlement::class,'receiver');
    }

    public function is_admin(){
        return $this->hasOne(AdminPermission::class)->where('status',true);
    }

    public function pin(){
        return $this->hasOne(Pin::class);
    }

    public function disputeCases(){
        return $this->hasMany(Order::class,'arbitrator_id')->whereHas('statuses',function($query){$query->where('name','disputed');});
    }

    public function disputes(){
        return $this->hasMany(Order::class,'arbitrator_id');
    }

    public function rejections(){
        return $this->morphMany(Rejection::class,'rejectable');
    }

    public function rejected(){
        return $this->morphOne(Rejection::class,'rejectable');
    }

    /**
     * Newsletter Relations
     */
    public function newsletterRecipients()
    {
        return $this->hasMany(NewsletterRecipient::class);
    }

    /**
     * Price Drop Pre-purchases
     */
    public function Prepurchases()
    {
        return $this->hasMany(Prepurchase::class);
    }

    public function activePrepurchases()
    {
        return $this->Prepurchases()
            ->where('status', 'pending')
            ->where('target_date', '>', now());
    }

    /**
     * Wishlist Relation (Updated for variants)
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    
    

    public function storeNewsletters()
    {
        return $this->hasManyThrough(Newsletter::class, Store::class);
    }

    /**
     * Helper Methods
     */
    public function hasActivePrePurchase(Product $product, ?ProductVariant $variant = null)
    {
        return $this->activePrepurchases()
            ->where('product_id', $product->id)
            ->when($variant, function($query) use ($variant) {
                $query->where('product_variant_id', $variant->id);
            })
            ->exists();
    }

    public function isSubscribedToStoreNewsletter(Store $store)
    {
        return $this->following()
            ->where('store_id', $store->id)
            ->exists();
    }

    /**
     * Scopes
     */
    public function scopeNewsletterSubscribers($query, Store $store)
    {
        return $query->whereHas('following', function($q) use ($store) {
            $q->where('store_id', $store->id);
        });
    }

    public function scopeHasPurchasedFrom($query, Store $store)
    {
        return $query->whereHas('orders', function($q) use ($store) {
            $q->where('store_id', $store->id)
                ->whereNotNull('completed_at');
        });
    }

    public function scopeRecentFollowers($query, $days = 30)
    {
        return $query->whereHas('following', function($q) use ($days) {
            $q->where('follows.created_at', '>=', now()->subDays($days));
        });
    }

    // public function receivesBroadcastNotificationsOn(){
    //     return 'users.'.$this->id;
    // }
    

    public function workplaces()
    {
        return $this->belongsToMany(Store::class, 'store_users')
                    ->withPivot('permissions', 'status')
                    ->withTimestamps();
    }

    public function activeWorkplaces()
    {
        return $this->belongsToMany(Store::class, 'store_users')
                    ->withPivot('permissions', 'status')
                    ->wherePivot('status', 'active')
                    ->withTimestamps();
    }

    // Helper method to check if user has specific permission for a store
    public function hasStorePermission($storeId, $permission)
    {
        $workplace = $this->workplaces()
                          ->wherePivot('store_id', $storeId)
                          ->wherePivot('status', 'active')
                          ->first();
                          
        if (!$workplace) return false;
        
        $permissions = json_decode($workplace->pivot->permissions, true) ?: [];
        
        return in_array($permission, $permissions);
    }

}
