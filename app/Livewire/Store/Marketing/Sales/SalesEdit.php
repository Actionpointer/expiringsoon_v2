<?php

namespace App\Livewire\Store\Marketing\Sales;

use App\Models\Store;
use App\Models\Product;
use App\Models\ProductSale;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesEdit extends Component
{
    public Store $store;
    public ProductSale $sale;
    public $selectedProduct = null;
    public $discountPercentage = 0;
    public $startDate = '';
    public $endDate = '';
    public $isFlashSale = false;
    public $frequencyMinutes = '';
    public $durationMinutes = '';
    public $allProducts = [];
    public $selectedProductData = null;

    protected $rules = [
        'selectedProduct' => 'required|exists:products,id',
        'discountPercentage' => 'required|numeric|min:0|max:100',
        'startDate' => 'required|date',
        'endDate' => 'nullable|date|after:startDate',
        'isFlashSale' => 'boolean',
        'frequencyMinutes' => 'required_if:isFlashSale,true|nullable|numeric|min:1',
        'durationMinutes' => 'required_if:isFlashSale,true|nullable|numeric|min:1',
    ];

    protected $messages = [
        'selectedProduct.required' => 'Please select a product.',
        'selectedProduct.exists' => 'The selected product is invalid.',
        'discountPercentage.required' => 'Discount percentage is required.',
        'discountPercentage.numeric' => 'Discount percentage must be a number.',
        'discountPercentage.min' => 'Discount percentage must be at least 0.',
        'discountPercentage.max' => 'Discount percentage cannot exceed 100.',
        'startDate.required' => 'Start date is required.',
        'startDate.date' => 'Start date must be a valid date.',
        'endDate.date' => 'End date must be a valid date.',
        'endDate.after' => 'End date must be after start date.',
        'frequencyMinutes.required_if' => 'Frequency is required for flash sales.',
        'durationMinutes.required_if' => 'Duration is required for flash sales.',
    ];

    protected $listeners = [
        'select2ValueUpdated' => 'handleSelect2Update',
    ];

    public function mount($store,$sale)
    {
        $this->store = $store;
        $this->allProducts = Product::where('store_id', $this->store->id)
            ->where('published', 1)
            ->get()
            ->map(function($product) {
                return [
                    'value' => $product->id,
                    'label' => $product->name,
                    'extra' => $product->image,
                ];
            })
            ->toArray();
    }

    public function handleSelect2Update($id, $value,$extra)
    {
        if ($id === 'product-select') {
            $this->selectedProduct = $value;
            $this->updatedSelectedProduct();
        }
    }

    public function updatedSelectedProduct()
    {
        if ($this->selectedProduct) {
            $product = Product::with('variants')->find($this->selectedProduct);
            if ($product) {
                $this->selectedProductData = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'variants' => $product->variants->map(function($variant) {
                        return [
                            'id' => $variant->id,
                            'name' => $variant->name,
                            'price' => $variant->price,
                            'stock' => $variant->stock,
                        ];
                    })->toArray()
                ];
            }
        } else {
            $this->selectedProductData = null;
        }
    }

    public function updatedIsFlashSale()
    {
        if (!$this->isFlashSale) {
            $this->frequencyMinutes = '';
            $this->durationMinutes = '';
        }
    }

    public function save($asDraft = false)
    {
        $this->validate();
        
        DB::beginTransaction();
        try {
            $sale = ProductSale::create([
                'product_id' => $this->selectedProduct,
                'discount_percentage' => $this->discountPercentage,
                'start_at' => $this->startDate,
                'end_at' => $this->endDate ?: null,
                'frequency_minutes' => $this->isFlashSale ? $this->frequencyMinutes : null,
                'duration_minutes' => $this->isFlashSale ? $this->durationMinutes : null,
                'published' => $asDraft ? 0 : 1,
            ]);
            
            DB::commit();
            session()->flash('success', 'Sale created successfully!');
            return redirect()->route('store.marketing.sales', $this->store);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create sale', [
                'error' => $e->getMessage(),
            ]);
            session()->flash('error', 'Failed to create sale: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.store.marketing.sales.sales-create', [
            'allProducts' => $this->allProducts,
            'selectedProductData' => $this->selectedProductData,
            'currencySymbol' => $this->store->country->currency_symbol ?? '$',
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}

