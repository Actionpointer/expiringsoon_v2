<?php

namespace App\Livewire\Store\Marketing\Giveaway;

use App\Models\Store;
use App\Models\ProductGiveaway;
use Livewire\Component;
use Livewire\WithPagination;

class GiveawayList extends Component
{
    use WithPagination;

    public Store $store;
    public $search = '';
    public $status = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    
    public function mount($store){
        $this->store = $store;
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }
    
    public function render()
    {
        $giveaways = ProductGiveaway::with(['productVariant.product'])
            ->whereHas('productVariant.product', function($query) {
                $query->where('store_id', $this->store->id);
            })
            ->when($this->search, function ($query) {
                $query->whereHas('productVariant.product', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                $query->where('published', $this->status === 'active' ? 1 : 0);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.store.marketing.giveaway.giveaway-list', [
            'giveaways' => $giveaways,
            'currencySymbol' => $this->store->country->currency_symbol ?? '$',
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
