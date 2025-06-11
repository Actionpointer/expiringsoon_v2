<?php

namespace App\Livewire\Store\Subscription;

use Carbon\Carbon;
use App\Models\Store;
use App\Models\Country;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Purchase;
use Illuminate\Support\Str;
use App\Models\PurchaseItem;
use App\Models\Subscription;
use App\Http\Traits\PaymentTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GeoLocationTrait;
use App\Models\CountrySubscriptionPlan;

class Plans extends Component
{
    use GeoLocationTrait, PaymentTrait;
    
    public $plans = [];
    public $location;
    public $country;
    public Store $store;
    // Form properties
    public $selectedPlanId;
    public $billingCycle = 'monthly';
    public $couponCode;
    public $autoRenew = true;
    public $subscription_url;
    // Listeners for JavaScript events
    protected $listeners = [
        'planSelected' => 'setPlan',
        'billingCycleChanged' => 'setBillingCycle'
    ];

    public function mount($store)
    {
        $this->store = $store;
        $this->subscription_url = route('store.settings.subscription',$this->store);
        $this->location = $this->getLocation();
        $this->country = Country::find($this->location->country_id);
        $this->plans = CountrySubscriptionPlan::where('country_id', $this->location->country_id)
            ->where('is_public', true)
            ->orderBy('monthly_price', 'asc')
            ->get();
    }
    
    public function setPlan($planId)
    {
        $this->selectedPlanId = $planId;
    }
    
    public function setBillingCycle($cycle)
    {
        $this->billingCycle = $cycle;
    }
    
    public function applyCoupon()
    {
        if (empty($this->couponCode)) {
            session()->flash('error', 'Please enter a coupon code');
            return;
        }
        
        // Here you would validate the coupon code against your database
        // For now, we'll just show a success message
        session()->flash('success', 'Coupon applied successfully!');
    }
    
    public function processSubscription()
    {
        // Validate required fields
        if (empty($this->selectedPlanId)) {
            session()->flash('error', 'Please select a plan');
            return;
        }
        
        try {
            // Get the selected plan
            $plan = CountrySubscriptionPlan::find($this->selectedPlanId);
            if (!$plan) {
                session()->flash('error', 'Selected plan not found');
                return;
            }
            
            // Get the current store ID from the route
            
            // Prepare data for the payment gateway
            $amount = $this->billingCycle === 'yearly' ? $plan->annual_price : $plan->monthly_price;
            
            // Start a database transaction
            DB::beginTransaction();
            
            // 1. Create subscription record
            $startDate = Carbon::now();
            $endDate = $this->billingCycle === 'yearly' 
                ? $startDate->copy()->addYear() 
                : $startDate->copy()->addMonth();
            $renewDate = $this->billingCycle === 'yearly' 
                ? $endDate->copy()->subWeeks(2) 
                : $endDate->copy()->subDays(3);
                
            $subscription = Subscription::create([
                'store_id' => $this->store->id,
                'country_subscription_plan_id' => $plan->id,
                'start_at' => $startDate,
                'renew_at' => $renewDate,
                'end_at' => $endDate,
                'status' => false, // Will be set to true after payment
                'auto_renew' => $this->autoRenew,
            ]);
            
            // 2. Create purchase record
            $purchase = Purchase::create([
                'store_id' => $this->store->id,
                'type' => 'subscription',
                'completed_at' => null, // Will be updated when payment is complete
            ]);
            
            // 3. Create purchase item record
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'purchaseable_id'=> $subscription->id,
                'purchaseable_type'=> get_class($subscription),
                'price' => $amount,
                'quantity' => 1,
                'amount' => $amount,
            ]);
            
            // // Set the subscription as the purchaseable
            // $purchaseItem->purchaseable()->associate($subscription);
            // $purchaseItem->save();
            
            // 4. Create payment record
            $payment = Payment::create([
                'user_id' => Auth::id(),
                'reference' => 'SUB-' . Str::random(10) . '-' . time(),
                'paymentable_id' => $purchase->id,
                'paymentable_type' => get_class($purchase),
                'currency_code' => strtolower($this->country->currency),
                'amount' => $amount,
                'coupon_id' => null, // No coupon for now
                'coupon_value' => '0',
                'vat_value' => 0, // No VAT for now
                'method' => null, // Will be set after payment gateway selection
                'status' => 'pending',
            ]);
            
            // // Set the purchase as the paymentable
            // $payment->paymentable()->associate($purchase);
            // $payment->save();
            
            // For free plans, skip payment process
            if ($amount == 0) {
                // Update records for free plan
                $purchase->completed_at = Carbon::now();
                $purchase->save();
                
                $subscription->status = true;
                $subscription->save();
                
                $payment->status = 'success';
                $payment->save();
                
                DB::commit();
                
                // Redirect to thank you page or store dashboard
                return redirect()->route('store.settings.subscription', ['store' => $this->store])
                    ->with('success', 'Your free subscription has been activated!');
            }
            
            // Initialize payment with gateway
            $gatewayResponse = $this->initializePayment($payment);
            
            if (!$gatewayResponse || !array_key_exists('redirect_url',$gatewayResponse) || empty($gatewayResponse['redirect_url'])) {
                throw new \Exception('Failed to initialize payment gateway');
            }
            
            // Commit the transaction
            DB::commit();
            
            // Redirect to payment gateway
            return redirect($gatewayResponse['redirect_url']);
            
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            
            Log::error('Error processing subscription', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'An error occurred while processing your subscription. Please try again.');
        }
    }
    
    public function render()
    {
        return view('livewire.store.subscription.plans')->extends('layouts.frontend.store.app')->section('content');
    }
}
