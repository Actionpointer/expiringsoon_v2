<?php

namespace App\Livewire\Store\Marketing\Giveaway;

use App\Models\Store;
use App\Models\ProductVariant;
use App\Models\ProductGiveaway;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GiveawayEdit extends Component
{
    public ProductGiveaway $giveaway;
    public Store $store;
    public $selectedProductVariant = null;
    public $maxPerUser = '';
    public $onlyCustomers = false;
    public $quantity = '';
    public $startAt = '';
    public $endAt = '';
    public $allVariants = [];
    public $selectedVariantData = null;

    protected $rules = [
        'selectedProductVariant' => 'required|exists:product_variants,id',
        'maxPerUser' => 'nullable|numeric|min:1',
        'onlyCustomers' => 'boolean',
        'quantity' => 'nullable|numeric|min:1',
        'startAt' => 'required|date',
        'endAt' => 'nullable|date|after:startAt',
    ];

    protected $messages = [
        'selectedProductVariant.required' => 'Please select a product variant.',
        'selectedProductVariant.exists' => 'The selected product variant is invalid.',
        'maxPerUser.numeric' => 'Maximum per user must be a number.',
        'maxPerUser.min' => 'Maximum per user must be at least 1.',
        'quantity.numeric' => 'Quantity must be a number.',
        'quantity.min' => 'Quantity must be at least 1.',
        'startAt.required' => 'Start date is required.',
        'startAt.date' => 'Start date must be a valid date.',
        'endAt.date' => 'End date must be a valid date.',
        'endAt.after' => 'End date must be after start date.',
    ];

    protected $listeners = [
        'select2ValueUpdated' => 'handleSelect2Update',
    ];

    public function mount($store,$giveaway)
    {
        $this->store = $store;
        $this->allVariants = ProductVariant::with('product')
            ->whereHas('product', function($query) {
                $query->where('store_id', $this->store->id);
            })
            ->get()
            ->map(function($variant) {
                return [
                    'value' => $variant->id,
                    'label' => $variant->name . ' (' . ($variant->product->name ?? '-') . ')',
                    'extra' => $variant->photo ?? '',
                ];
            })
            ->toArray();
    }

    public function handleSelect2Update($id, $value, $extra)
    {
        if ($id === 'product-variant-select') {
            $this->selectedProductVariant = $value;
            $this->updatedSelectedProductVariant();
        }
    }

    public function updatedSelectedProductVariant()
    {
        if ($this->selectedProductVariant) {
            $variant = ProductVariant::with('product')->find($this->selectedProductVariant);
            if ($variant) {
                $this->selectedVariantData = [
                    'id' => $variant->id,
                    'name' => $variant->name,
                    'product_name' => $variant->product->name ?? '-',
                    'image' => $variant->photo ?? '',
                    'price' => $variant->price,
                    'stock' => $variant->stock,
                ];
            }
        } else {
            $this->selectedVariantData = null;
        }
    }

    public function save($asDraft = false)
    {
        $this->validate();
        
        DB::beginTransaction();
        try {
            $giveaway = ProductGiveaway::create([
                'product_variant_id' => $this->selectedProductVariant,
                'price' => $this->selectedVariantData['price'],
                'currency_code' => $this->store->country->currency_code ?? 'USD',
                'max_per_user' => $this->maxPerUser ?: null,
                'quantity' => $this->quantity ?: null,
                'start_at' => $this->startAt,
                'end_at' => $this->endAt ?: null,
                'only_customers' => $this->onlyCustomers,
                'status' => $asDraft ? 0 : 1,
            ]);
            
            DB::commit();
            session()->flash('success', 'Giveaway created successfully!');
            return redirect()->route('store.marketing.giveaways', $this->store);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create giveaway', [
                'error' => $e->getMessage(),
            ]);
            session()->flash('error', 'Failed to create giveaway: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.store.marketing.giveaway.giveaway-create', [
            'allVariants' => $this->allVariants,
            'selectedVariantData' => $this->selectedVariantData,
            'currencySymbol' => $this->store->country->currency_symbol ?? '$',
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
