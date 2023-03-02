<?php

namespace App\Providers;

use App\Events\AdjustCart;
use App\Events\RefundBuyer;
use App\Events\RetryPayout;
use App\Events\DisbursePayout;
use App\Events\OrderCompleted;
use App\Events\OrderPurchased;
use App\Events\UserSubscribed;
use App\Events\DecreaseProduct;
use App\Events\SettleVendor;
use App\Listeners\SettlingVendor;
use App\Listeners\AdjustingCart;
use App\Events\CheckPayoutStatus;
use App\Events\RenewSubscription;
use App\Listeners\BroadcastOrder;
use App\Listeners\RefundingBuyer;
use App\Listeners\RetryingPayout;
use App\Events\SubscriptionExpired;
use App\Listeners\DisbursingPayout;
use App\Listeners\DecreasingProduct;
use App\Listeners\RemoveFromWishList;
use Illuminate\Support\Facades\Event;
use App\Listeners\ShopDeleteProcesses;
use Illuminate\Auth\Events\Registered;
use App\Listeners\CheckingPayoutStatus;
use App\Listeners\AutoRenewSubscription;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\UserLoggedOut',
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],
        AdjustCart::class => [
            AdjustingCart::class
        ],
        DecreaseProduct::class => [
            DecreasingProduct::class
        ],
        OrderPurchased::class => [
            BroadcastOrder::class
        ],
        RefundBuyer::class => [
            RefundingBuyer::class
        ],
        OrderCompleted::class => [
            SettleVendor::class,
            RemoveFromWishList::class,
        ],
        SettleVendor::class => [
            SettlingVendor::class
        ],
        
        DisbursePayout::class => [
            DisbursingPayout::class
        ],
        RetryPayout::class => [
            RetryingPayout::class
        ],
        CheckPayoutStatus::class => [
            CheckingPayoutStatus::class
        ],
        
    ];

    protected $subscribe = [
        'App\Listeners\ResetShopsAndProductsStatus',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
