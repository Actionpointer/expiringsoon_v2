<?php

namespace App\Livewire\Store\Settings;

use App\Models\Store;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Subscription;
use Livewire\Component;

class StoreSubscription extends Component
{
    public Store $store;
    public $currentSubscription;
    public $subscriptionPlan;
    public $billingHistory;
    public $usageStats;

    public function mount($store)
    {
        $this->store = $store;
        $this->loadSubscriptionData();
    }

    public function loadSubscriptionData()
    {
        // Get current active subscription
        $this->currentSubscription = $this->store->active_subscription();
        
        if ($this->currentSubscription) {
            $this->subscriptionPlan = $this->currentSubscription->plan;
        }

        // Load billing history (payments for this store's subscriptions)
        $this->billingHistory = Payment::whereHas('paymentable', function($query) {
            $query->whereHas('items', function($subQuery) {
                $subQuery->where('purchaseable_type', Subscription::class)
                    ->whereHas('purchaseable', function($purchaseableQuery) {
                        $purchaseableQuery->where('store_id', $this->store->id);
                    });
            });
        })
        ->where('status', 'success')
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();

        // Calculate usage statistics
        $this->calculateUsageStats();
    }

    public function calculateUsageStats()
    {
        if (!$this->subscriptionPlan) {
            $this->usageStats = [
                'products' => ['used' => 0, 'limit' => 0, 'percentage' => 0],
                'storage' => ['used' => 0, 'limit' => 0, 'percentage' => 0],
                'staff' => ['used' => 0, 'limit' => 0, 'percentage' => 0],
                'withdrawals' => ['used' => 0, 'limit' => 0, 'percentage' => 0],
            ];
            return;
        }

        // Products usage
        $productsCount = $this->store->products()->count();
        $productsLimit = $this->subscriptionPlan->products;

        // Storage usage (simplified - you might want to calculate actual file sizes)
        $storageUsed = 0; // This would be calculated from actual file sizes
        $storageLimit = $this->subscriptionPlan->storage_mb;

        // Staff usage
        $staffCount = $this->store->activeStaff()->count();
        $staffLimit = $this->subscriptionPlan->staff;

        // Withdrawals usage (this month)
        $withdrawalsThisMonth = $this->store->payouts()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $withdrawalsLimit = $this->subscriptionPlan->withdrawal_count;

        $this->usageStats = [
            'products' => [
                'used' => $productsCount,
                'limit' => $productsLimit,
                'percentage' => $productsLimit > 0 ? min(100, ($productsCount / $productsLimit) * 100) : 0
            ],
            'storage' => [
                'used' => $storageUsed,
                'limit' => $storageLimit,
                'percentage' => $storageLimit > 0 ? min(100, ($storageUsed / $storageLimit) * 100) : 0
            ],
            'staff' => [
                'used' => $staffCount,
                'limit' => $staffLimit,
                'percentage' => $staffLimit > 0 ? min(100, ($staffCount / $staffLimit) * 100) : 0
            ],
            'withdrawals' => [
                'used' => $withdrawalsThisMonth,
                'limit' => $withdrawalsLimit,
                'percentage' => $withdrawalsLimit > 0 ? min(100, ($withdrawalsThisMonth / $withdrawalsLimit) * 100) : 0
            ],
        ];
    }

    public function getSubscriptionStatus()
    {
        if (!$this->currentSubscription) {
            return 'inactive';
        }

        if (!$this->currentSubscription->status) {
            return 'pending';
        }

        if ($this->currentSubscription->end_at && $this->currentSubscription->end_at < now()) {
            return 'expired';
        }

        return 'active';
    }

    public function getNextBillingDate()
    {
        if (!$this->currentSubscription || !$this->currentSubscription->renew_at) {
            return null;
        }

        return $this->currentSubscription->renew_at;
    }

    public function getSubscriptionPrice()
    {
        if (!$this->subscriptionPlan) {
            return null;
        }

        // Determine if it's monthly or yearly based on subscription duration
        if ($this->currentSubscription) {
            $duration = $this->currentSubscription->start_at->diffInMonths($this->currentSubscription->end_at);
            return $duration >= 12 ? $this->subscriptionPlan->annual_price : $this->subscriptionPlan->monthly_price;
        }

        return $this->subscriptionPlan->monthly_price;
    }

    public function getBillingCycle()
    {
        if (!$this->currentSubscription) {
            return 'monthly';
        }

        $duration = $this->currentSubscription->start_at->diffInMonths($this->currentSubscription->end_at);
        return $duration >= 12 ? 'yearly' : 'monthly';
    }

    public function getSubscriptionId()
    {
        if (!$this->currentSubscription) {
            return null;
        }

        return 'SUB-' . str_pad($this->currentSubscription->id, 8, '0', STR_PAD_LEFT);
    }

    public function getBillingHistoryData()
    {
        $history = [];
        
        foreach ($this->billingHistory as $payment) {
            $subscription = null;
            
            // Get the subscription from the purchase item
            if ($payment->paymentable && $payment->paymentable->items) {
                foreach ($payment->paymentable->items as $item) {
                    if ($item->purchaseable_type === Subscription::class) {
                        $subscription = $item->purchaseable;
                        break;
                    }
                }
            }
            
            if ($subscription) {
                $history[] = [
                    'date' => $payment->created_at->format('M d, Y'),
                    'description' => $subscription->plan->name . ' Subscription',
                    'amount' => $payment->amount,
                    'status' => ucfirst($payment->status),
                    'reference' => $payment->reference,
                    'subscription' => $subscription
                ];
            }
        }
        
        return $history;
    }

    public function hasActiveSubscription()
    {
        return $this->currentSubscription && $this->getSubscriptionStatus() === 'active';
    }

    public function getPlanFeatures()
    {
        if (!$this->subscriptionPlan) {
            return [];
        }

        return [
            [
                'title' => "Up to {$this->subscriptionPlan->products} Products",
                'description' => "List up to {$this->subscriptionPlan->products} products in your store"
            ],
            [
                'title' => "{$this->subscriptionPlan->storage_mb} MB Storage",
                'description' => "For product images and files"
            ],
            [
                'title' => "{$this->subscriptionPlan->staff} Staff Accounts",
                'description' => "Add up to {$this->subscriptionPlan->staff} team members"
            ],
            [
                'title' => "{$this->subscriptionPlan->newsletter_credits} Newsletter Credits",
                'description' => "Send newsletters to your customers"
            ],
            [
                'title' => "{$this->subscriptionPlan->commission}% Commission",
                'description' => "Platform commission rate on sales"
            ],
            [
                'title' => "Withdrawal Limits",
                'description' => "{$this->store->currency_symbol}{$this->subscriptionPlan->minimum_withdrawal} - {$this->store->currency_symbol}{$this->subscriptionPlan->maximum_withdrawal}"
            ],
            [
                'title' => "Withdrawal Frequency",
                'description' => $this->getWithdrawalIntervalDescription()
            ],
            [
                'title' => "Monthly Withdrawals",
                'description' => "Up to {$this->subscriptionPlan->withdrawal_count} withdrawals per month"
            ]
        ];
    }

    public function getWithdrawalStats()
    {
        if (!$this->subscriptionPlan) {
            return null;
        }

        $thisMonthWithdrawals = $this->store->payouts()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        $totalWithdrawnThisMonth = $thisMonthWithdrawals->sum('amount');
        $averageWithdrawal = $thisMonthWithdrawals->count() > 0 ? $totalWithdrawnThisMonth / $thisMonthWithdrawals->count() : 0;

        return [
            'this_month_count' => $thisMonthWithdrawals->count(),
            'this_month_total' => $totalWithdrawnThisMonth,
            'average_withdrawal' => $averageWithdrawal,
            'remaining_withdrawals' => max(0, $this->subscriptionPlan->withdrawal_count - $thisMonthWithdrawals->count()),
            'min_withdrawal' => $this->subscriptionPlan->minimum_withdrawal,
            'max_withdrawal' => $this->subscriptionPlan->maximum_withdrawal,
            'interval' => ucfirst(str_replace('_', ' ', $this->subscriptionPlan->withdrawal_interval)),
            'commission_rate' => $this->subscriptionPlan->commission
        ];
    }

    public function getWithdrawalIntervalDescription()
    {
        if (!$this->subscriptionPlan) {
            return '';
        }

        $interval = $this->subscriptionPlan->withdrawal_interval;
        
        switch ($interval) {
            case 'instant':
                return 'Instant processing (within minutes)';
            case 'same_day':
                return 'Same day processing';
            case 'next_day':
                return 'Next business day processing';
            case '2_3_bdays':
                return '2-3 business days processing';
            default:
                return ucfirst(str_replace('_', ' ', $interval)) . ' processing';
        }
    }

    public function render()
    {
        return view('livewire.store.settings.store-subscription')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
