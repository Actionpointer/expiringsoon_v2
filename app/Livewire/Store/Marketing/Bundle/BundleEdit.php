<?php

namespace App\Livewire\Store\Marketing\Bundle;

use App\Models\ProductBundle;
use App\Models\ProductBundleVariant;
use App\Models\ProductVariant;
use App\Models\Store;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BundleCreate extends Component
{
    public Store $store;
    public ProductBundle $bundle;
    public $title;
    public $selectedVariants = [];
    public $price = 1;
    public $image;
    public $allVariants = [];
    public $summaryVariants = [];


    protected $rules = [
        'title' => 'required|string',
        'selectedVariants' => 'required|array',
        'price' => 'required|numeric|min:0',
        'image' => 'required|string',
    ];

    protected $messages = [
        'title.required' => 'The bundle title is required.',
        'selectedVariants.required' => 'Please select at least one product variant.',
        'price.required' => 'The bundle price is required.',
        'price.numeric' => 'The bundle price must be a number.',
        'image.required' => 'Please select a bundle image.',
    ];

    protected $listeners = [
        'select2MultipleValuesUpdated' => 'handleSelect2Update',
        'fileManagerValueUpdated' => 'handleFileManagerUpdate'
    ];

    public function mount($store,$bundle)
    {
        $this->store = $store;
        $this->allVariants = ProductVariant::with('product')->get()->map(function($variant) {
            return [
                'id' => $variant->id,
                'name' => $variant->name . ' (' . ($variant->product->name ?? '-') . ')',
                'price' => $variant->price,
                'stock' => $variant->stock,
            ];
        })->toArray();
    }

    public function handleSelect2Update($id, $values)
    {
        if ($id === 'bundle-variants-select') {
            $this->selectedVariants = $values ?? [];
            $this->updatedSelectedVariants();
        }
    }

    public function handleFileManagerUpdate($value,$wireModel,$inputId)
    {
        if ($inputId === 'bundle-image-input') {
            $this->image = $value;
        }
    }

    public function updatedSelectedVariants()
    {
        $this->summaryVariants = collect($this->allVariants)
            ->whereIn('id', $this->selectedVariants)
            ->values()
            ->toArray();
    }

    public function updatedPrice()
    {
        if (empty($this->price) || $this->price === '') {
            $this->price = 0;
        }
    }

    public function save($asDraft = false)
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $bundle = ProductBundle::create([
                'name' => $this->title,
                'price' => $this->price,
                'currency_code' => $this->price,
                'photo' => $this->image,
                'published' => $asDraft ? 0 : 1,
            ]);
            foreach ($this->selectedVariants as $variantId) {
                ProductBundleVariant::create([
                    'product_bundle_id' => $bundle->id,
                    'product_variant_id' => $variantId,
                ]);
            }
            DB::commit();
            session()->flash('success', 'Bundle created successfully!');
            return redirect()->route('store.marketing.bundles', $this->store);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to create bundle', [
                'error' => $e->getMessage(),
            ]);
            session()->flash('error', 'Failed to create bundle: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.store.marketing.bundle.bundle-create', [
            'allVariants' => $this->allVariants,
            'summaryVariants' => $this->summaryVariants,
            'currencySymbol' => $this->store->country->currency_symbol ?? '$',
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
