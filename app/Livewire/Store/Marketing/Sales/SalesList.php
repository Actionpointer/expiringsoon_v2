<?php

namespace App\Livewire\Store\Marketing\Sales;

use App\Models\Store;
use Livewire\Component;
use App\Models\ProductSale;
use Livewire\WithPagination;

class SalesList extends Component
{
    use WithPagination;

    public $store;
    public $search = '';
    public $status = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    
    public function mount(){
        $this->store = Store::firstWhere('slug',request()->store);
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
        $sales = ProductSale::with('product')
            ->whereHas('product', function($query) {
                $query->where('store_id', $this->store->id);
            })
            ->when($this->search, function ($query) {
                $query->whereHas('product', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status === 'active' ? 1 : 0);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.store.marketing.sales.sales-list', [
            'sales' => $sales,
            'currencySymbol' => $this->store->country->currency_symbol ?? '$',
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
