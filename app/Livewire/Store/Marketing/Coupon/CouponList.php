<?php

namespace App\Livewire\Store\Marketing\Coupon;

use App\Models\Store;
use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class CouponList extends Component
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
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function render()
    {
        $coupons = Coupon::where('store_id', $this->store->id)
            ->when($this->search, function ($query) {
                $query->where('code', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                $publishedValue = $this->status === 'active' ? 1 : 0;
                $query->where('published', $publishedValue);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.store.marketing.coupon.coupon-list', [
            'coupons' => $coupons,
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
