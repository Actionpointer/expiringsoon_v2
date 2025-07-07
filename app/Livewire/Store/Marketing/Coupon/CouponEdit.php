<?php

namespace App\Livewire\Store\Marketing\Coupon;

use App\Models\Store;
use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CouponEdit extends Component
{
    public Coupon $coupon;
    public Store $store;
    public $name = '';
    public $code = '';
    public $quantity = 1;
    public $description = '';
    public $startDate = '';
    public $endDate = '';
    public $isPercentage = true;
    public $value = 0;
    public $minimumSpend = '';
    public $cap = '';
    public $limitPerUser = '';
    public $selectedProducts = [];
    public $allProducts = [];

    protected function rules(){
        return [
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('coupons')->where(function ($query) {
                    return $query->where('store_id', $this->store->id);
                })
            ],
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date|after:startDate',
            'isPercentage' => 'boolean',
            'value' => 'required|numeric|min:0',
            'minimumSpend' => 'nullable|numeric|min:0',
            'cap' => 'nullable|numeric|min:0',
            'limitPerUser' => 'nullable|integer|min:1',
            'selectedProducts' => 'array',
        ];
    }

    protected $messages = [
        'name.required' => 'Coupon name is required.',
        'code.required' => 'Coupon code is required.',
        'code.unique' => 'This coupon code already exists.',
        'quantity.required' => 'Quantity is required.',
        'quantity.min' => 'Quantity must be at least 1.',
        'startDate.required' => 'Start date is required.',
        'startDate.date' => 'Start date must be a valid date.',
        'endDate.date' => 'End date must be a valid date.',
        'endDate.after' => 'End date must be after start date.',
        'value.required' => 'Value is required.',
        'value.numeric' => 'Value must be a number.',
        'value.min' => 'Value must be at least 0.',
        'minimumSpend.numeric' => 'Minimum spend must be a number.',
        'minimumSpend.min' => 'Minimum spend must be at least 0.',
        'cap.numeric' => 'Cap must be a number.',
        'cap.min' => 'Cap must be at least 0.',
        'limitPerUser.integer' => 'Limit per user must be a whole number.',
        'limitPerUser.min' => 'Limit per user must be at least 1.',
    ];

    public function mount($store,$coupon)
    {
        $this->store = $store;
        $this->allProducts = Product::where('store_id', $this->store->id)
            ->where('published', 1)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedIsPercentage()
    {
        // Reset value when switching between percentage and fixed amount
        $this->value = 0;
    }

    public function save($asDraft = false)
    {
        $this->validate();
        
        DB::beginTransaction();
        try {
            $coupon = Coupon::create([
                'store_id' => $this->store->id,
                'name' => $this->name,
                'code' => strtoupper($this->code),
                'quantity' => $this->quantity,
                'description' => $this->description,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate ?: null,
                'is_percentage' => $this->isPercentage,
                'value' => $this->value,
                'minimum_spend' => $this->minimumSpend ?: null,
                'cap' => $this->cap ?: null,
                'currency_code' => $this->store->country->currency_code ?? 'USD',
                'limit_per_user' => $this->limitPerUser ?: null,
                'status' => $asDraft ? 0 : 1,
            ]);
            
            DB::commit();
            session()->flash('success', 'Coupon created successfully!');
            return redirect()->route('store.marketing.coupons', $this->store);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create coupon', [
                'error' => $e->getMessage(),
            ]);
            session()->flash('error', 'Failed to create coupon: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.store.marketing.coupon.coupon-create', [
            'allProducts' => $this->allProducts,
            'currencySymbol' => $this->store->country->currency_symbol ?? '$',
        ])
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
