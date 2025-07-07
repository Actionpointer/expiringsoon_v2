<?php

namespace App\Livewire\Store\Settings;

use App\Models\Store;
use Livewire\Component;
use App\Models\BankAccount;
use App\Models\CountryBanking;
use App\Models\CountryGateway;
use App\Http\Traits\PayoutTrait;

class StoreBankAccount extends Component
{
    use PayoutTrait;

    public Store $store;
    public $countryGateways = [];
    public $showPayoutModal = false;
    public $selectedGateway = null;
    public $payoutFields = [];
    public $payoutData = [];
    public $bankAccounts = [];
    public $bankLists = [];

    public function mount($store)
    {
        $this->store = $store;
        $this->loadBankAccounts();
        $this->countryGateways = CountryGateway::where('country_id', $store->country_id)
            ->where('status', true)
            ->with('gateway')
            ->get();
    }

    public function loadBankAccounts()
    {
        $this->bankAccounts = BankAccount::where('store_id', $this->store->id)->get();
    }

    public function getBankListForGateway($gateway, $country)
    {
        $key = $gateway . '_' . $country;
        if (!isset($this->bankLists[$key])) {
            $banks = $this->listBanks($gateway, $country);
            $this->bankLists[$key] = is_array($banks) ? $banks : [];
        }
        return $this->bankLists[$key];
    }

    public function savePayoutMethodForGateway($gatewayId)
    {
        $fields = $this->payoutData[$gatewayId] ?? [];
        $gateway = CountryGateway::with('gateway')->find($gatewayId);

        // Prepare data for top-level columns
        $data = [
            'store_id' => $this->store->id,
            'gateway' => $gateway->gateway->slug ?? $gateway->gateway->name,
            'gateway_reference' => $fields['gateway_reference'] ?? null,
            'account_status' => false,
            'primary_account' => false,
        ];

        // Map known fields to columns if present
        $columnFields = [
            'account_number', 'bank_code', 'bank_name', 'account_name', 'currency'
        ];
        foreach ($columnFields as $col) {
            if (isset($fields[$col])) {
                $data[$col] = $fields[$col];
            }
        }

        // Store all fields in banking_fields JSON for completeness
        $data['banking_fields'] = $fields ? json_encode($fields) : null;

        BankAccount::create($data);
        $this->loadBankAccounts();
        session()->flash('success', 'Payout method saved successfully.');
    }

    public function connectAccount($gatewayId)
    {
        $gateway = CountryGateway::with('gateway')->find($gatewayId);
        $slug = $gateway->gateway->slug ?? $gateway->gateway->name;
        $country = $this->store->country->iso2;

        // Use trait to get the connect URL
        $url = $this->getConnectUrl($slug, $country, $this->store);

        if ($url) {
            return redirect()->away($url);
        } else {
            session()->flash('error', 'Unable to generate connect link for this gateway.');
        }
    }

    // Stub for connect URL logic
    public function getConnectUrl($gatewaySlug, $country, $store)
    {
        // Example: handle Stripe, PayPal, etc.
        // if ($gatewaySlug === 'stripe') {
        //     return $this->stripeConnectUrl($store);
        // }
        // Add more gateway logic as needed
        return null;
    }

    public function removePayoutMethod($id)
    {
        $account = BankAccount::where('store_id', $this->store->id)->where('id', $id)->first();
        if ($account) {
            $account->delete();
            $this->loadBankAccounts();
            session()->flash('success', 'Payout method removed successfully.');
        }
    }

    public function render()
    {
        return view('livewire.store.settings.store-bank-account')     
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
