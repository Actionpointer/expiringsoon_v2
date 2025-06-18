<?php

namespace App\Livewire\Store\Product;

use App\Models\Product;
use App\Models\Store;
use Livewire\Component;

class ProductEdit extends Component
{
    public Store $store;
    public Product $product;

    public function edit(Store $store, Product $product)
    {
        $categories = $store->categories()->get();
        
        return view('store.products.partials.edit-form', [
            'product' => $product,
            'store' => $store,
            'categories' => $categories
        ]);
    }
    public function render()
    {
        return view('livewire.store.product.product-edit')->extends('layouts.frontend.store.app')->section('content');
    }
}
