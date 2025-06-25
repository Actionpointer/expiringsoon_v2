<?php

namespace App\Livewire\Store\Marketing\Bundle;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductBundle;

class BundleList extends Component
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
        $bundles = ProductBundle::with('productBundleVariants.variant')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                $publishedValue = $this->status === 'published' ? 1 : 0;
                $query->where('published', $publishedValue);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.store.marketing.bundle.bundle-list', [
            'bundles' => $bundles,
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
