<?php

namespace App\Providers;

use App\Events\DeleteShop;
use App\Events\RetryPayout;
use App\Events\RenewFeature;
use App\Events\DisbursePayout;
use App\Events\OrderCompleted;
use App\Events\OrderPurchased;
use App\Events\UserSubscribed;
use App\Listeners\SettleVendor;
use App\Listeners\ResetShopStatus;
use App\Events\CheckPayoutStatus;
use App\Events\RenewSubscription;
use App\Listeners\RetryingPayout;
use App\Listeners\DecreaseProduct;
use App\Events\SubscriptionExpired;
use App\Listeners\AutoRenewFeature;
use App\Listeners\DisbursingPayout;
use App\Listeners\ResetProductStatus;
use App\Listeners\RemoveFromWishList;
use Illuminate\Support\Facades\Event;
use App\Listeners\ShopDeleteProcesses;
use Illuminate\Auth\Events\Registered;
use App\Listeners\CheckingPayoutStatus;
use App\Listeners\AutoRenewSubscription;
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
        OrderPurchased::class => [
            DecreaseProduct::class,
            RemoveFromWishList::class,
        ],
        OrderCompleted::class => [
            SettleVendor::class,
            RemoveFromWishList::class,
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
