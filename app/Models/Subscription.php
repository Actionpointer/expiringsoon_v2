<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\User;
use App\Models\Advert;
use App\Models\PaymentItem;
use App\Observers\SubscriptionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Subscription extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'store_id',
        'country_subscription_plan_id',
        'start_at',
        'renew_at',
        'end_at',
        'status',
        'auto_renew',
    ];
    protected $appends = ['active','duration','is_free'];
    protected $casts = [
        'start_at' => 'datetime',
        'renew_at' => 'datetime',
        'end_at' => 'datetime',
        'status' => 'boolean',
        'auto_renew' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        parent::observe(new SubscriptionObserver);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment_item(){
        return $this->morphOne(PaymentItem::class,'paymentable');
    }
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get the subscription plan associated with this subscription.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(CountrySubscriptionPlan::class, 'country_subscription_plan_id');
    }

    public function purchaseItem()
    {
        return $this->morphOne(PurchaseItem::class, 'purchaseable');
    }

    public function getDurationAttribute(){
        return $this->start_at->diffInMonths($this->end_at);   
    }

    public function getActiveAttribute(){
        return  $this->start_at < now() && $this->end_at > now() && $this->status;
    }
    
    public function getIsFreeAttribute(){
        return  !$this->renew_at && !$this->end_at;
    }

    public function expired(){
        return $this->start_at < now() && $this->end_at < now();
    }
    
    public function scopeExpired($query){
        return $query->where('start_at','<',now())->where('end_at','<',now());
    }

    /**
     * Get the store that owns the subscription.
     */
    

    /**
     * Get the purchase items for this subscription.
     */
    public function purchaseItems(): MorphMany
    {
        return $this->morphMany(PurchaseItem::class, 'purchaseable');
    }

    /**
     * Check if the subscription is active.
     */
    public function isActive(): bool
    {
        return $this->status && ($this->end_at === null || $this->end_at->isFuture());
    }
}
