<?php

namespace App\Livewire\Store\Marketing\Advert;

use Livewire\Component;
use App\Models\Store;
use App\Models\CountryAdPlan;

class AdvertList extends Component
{
    public $store;
    public $countryAdplans;

    public function mount($store)
    {
        $this->store = $store instanceof Store ? $store : Store::where('slug', $store)->firstOrFail();
        $this->countryAdplans = CountryAdPlan::where('country_id', $this->store->country_id)
            ->where('is_active', 1)
            ->get();
    }

    public function render()
    {
        return view('livewire.store.marketing.advert.advert-list', [
            'countryAdplans' => $this->countryAdplans,
            'store' => $this->store,
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 