<?php

namespace App\Models;


use App\Models\Cart;
use App\Models\Like;
use App\Models\AdminPermission;
use App\Models\Shop;
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

    protected $appends = ['balance','image','max_products','total_products','total_shops','max_shops'];

    
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
    
    public function shops(){
        return $this->hasMany(Shop::class);
    }
    
    public function getBalanceAttribute(){
        return $this->shops->sum('wallet');   
    }
    public function products(){  
        return $this->hasManyThrough(Product::class,Shop::class,'user_id','shop_id');
    }
    public function shopOrders(){
        return $this->hasManyThrough(Order::class,Shop::class,'user_id','shop_id');
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
        if($this->shop_id)
            return $this->shop->user->products->count();
        else return $this->products->count();
    }
    public function getTotalShopsAttribute(){
        if($this->shop_id)
            return $this->shop->user->shops->count();
        else return $this->shops->count();
    }
    public function getMaxShopsAttribute(){
        if($this->shop_id)
            return $this->shop->user->subscription->plan->shops;
        elseif($this->subscription)
            return $this->subscription->plan->shops;
    }
    public function getMaxProductsAttribute(){
        if($this->shop_id)
            return $this->shop->user->subscription->plan->products;
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


    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function following(){
        return $this->belongsToMany(Shop::class,'follows','user_id','shop_id');
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

    
    

    public function shopNewsletters()
    {
        return $this->hasManyThrough(Newsletter::class, Shop::class);
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

    public function isSubscribedToShopNewsletter(Shop $shop)
    {
        return $this->following()
            ->where('shop_id', $shop->id)
            ->exists();
    }

    /**
     * Scopes
     */
    public function scopeNewsletterSubscribers($query, Shop $shop)
    {
        return $query->whereHas('following', function($q) use ($shop) {
            $q->where('shop_id', $shop->id);
        });
    }

    public function scopeHasPurchasedFrom($query, Shop $shop)
    {
        return $query->whereHas('orders', function($q) use ($shop) {
            $q->where('shop_id', $shop->id)
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
    

        

}
