<?php

namespace App\Livewire\Store\Product;

use Carbon\Carbon;
use App\Models\Store;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductCreate extends Component
{
    public Store $store;

    // Basic product information
    public $name = '';
    public $description = '';
    public $meta_description = '';
    public $photos = '';
    public $categories = [];
    public $category_id = '';

    // Product availability
    public $preorder = false;
    public $always_available = false;
    public $expire_at = '';
    public $expiry_term = '';

    // Discount settings
    public $discount30 = '';
    public $discount60 = '';
    public $discount90 = '';
    public $discount120 = '';

    // Product status
    public $published = false;

    public $variantData = [];

    protected function getListeners()
    {
        return [
            'summernoteContentUpdated' => 'handleDescriptionUpdate',
            'fileManagerValueUpdated' => 'handlePhotoUpdate',
            'select2ValueUpdated' => 'handleCategoryUpdate',
            'attributesChanged' => 'handleAttributesChanged',
            'variantsAttributesChanged' => 'handleVariantsAttributesChanged',
            'variantDataReceived' => 'handleVariantDataReceived'
        ];
    }

    public function handleDescriptionUpdate($content, $wireModel)
    {
        if ($wireModel === 'description') {
            $this->description = $content;
        }
    }

    public function handlePhotoUpdate($value, $wireModel)
    {
        if ($wireModel === 'photos') {
            $this->photos = $value;
        }
    }

    public function handleCategoryUpdate($value, $wireModel)
    {
        if ($wireModel === 'category_id') {
            $this->category_id = $value;
        }
    }

    public function handleAttributesChanged($data)
    {
        // This will be handled by the ProductVariants component
        $this->dispatch('attributesChanged', $data);
    }

    public function handleVariantsAttributesChanged($data)
    {
        // Handle variant attribute changes if needed
    }

    public function handleVariantDataReceived($data)
    {
        $this->variantData = $data['variants'];
    }

    public function mount($store)
    {
        $this->discount30 = 29;
        $this->store = $store;
        $this->expire_at = now()->addMonths(3)->format('Y-m-d');
        $this->categories = Category::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:10',
            'meta_description' => 'nullable|max:255',
            'photos' => 'required|string',
            'category_id' => 'required',
            'preorder' => 'boolean',
            'always_available' => 'boolean',
            'expire_at' => 'required_if:always_available,false|nullable|date|after:today',
            'expiry_term' => 'nullable|string',
            'discount30' => 'required|numeric|min:0',
            'discount60' => 'required|numeric|min:0',
            'discount90' => 'required|numeric|min:0',
            'discount120' => 'required|numeric|min:0',
            'published' => 'boolean',
            'variants' => 'required|array|min:1',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.options' => 'nullable',
            'variants.*.photo' => 'nullable|string',
        ];
    }

    protected $messages = [
        'category_id.required' => 'Please select a category',
        'photos.required' => 'Please provide at least one product image URL',
        'expire_at.required_if' => 'Expiry date is required when the product is not always available',
        'expire_at.after' => 'Expiry date must be after today',
        'variants.*.price.required' => 'Price is required for all variants',
        'variants.*.stock.required' => 'Stock quantity is required for all variants',
    ];


    public function getPhotoArrayAttribute()
    {
        if (empty($this->photos)) {
            return [];
        }

        return explode(',', $this->photos);
    }

    public function validateDiscounts()
    {
        // Ensure discounts are in descending order (30d > 60d > 90d > 120d)
        if ($this->discount30 < $this->discount60) {
            $this->addError('discount30', '30-day discount must be greater than 60-day discount');
            return false;
        }

        if ($this->discount60 < $this->discount90) {
            $this->addError('discount60', '60-day discount must be greater than 90-day discount');
            return false;
        }

        if ($this->discount90 < $this->discount120) {
            $this->addError('discount90', '90-day discount must be greater than 120-day discount');
            return false;
        }

        return true;
    }

    public function saveAsDraft()
    {
        $this->published = false;
        $this->saveProduct();
    }

    public function saveAsPublished()
    {
        $this->published = true;
        $this->saveProduct();
    }

    public function saveProduct()
    {
        $this->validate();

        if (!$this->validateDiscounts()) {
            return false;
        }

        try {
            DB::beginTransaction();

            // Create the product
            $product = new Product();
            $product->store_id = $this->store->id;
            $product->category_id = $this->category_id;
            $product->name = $this->name;
            $product->description = $this->description;
            $product->meta_description = $this->meta_description;
            $product->photos = $this->photo_array;
            $product->preorder = $this->preorder;
            $product->always_available = $this->always_available;
            $product->expire_at = $this->always_available ? null : Carbon::parse($this->expire_at);
            $product->expiry_term = $this->expiry_term;
            $product->discount30 = $this->discount30;
            $product->discount60 = $this->discount60;
            $product->discount90 = $this->discount90;
            $product->discount120 = $this->discount120;
            $product->published = $this->published;

            $product->save();

            // Get variant data from the ProductVariants component
            $this->dispatch('getVariantData');

            // Wait a moment for the variant data to be received
            usleep(100000); // 0.1 seconds

            // Save variants if we have variant data
            if (!empty($this->variantData)) {
                foreach ($this->variantData as $variantData) {
                    // Convert options to JSON
                    $options = isset($variantData['options']) ? $variantData['options'] : [];

                    // Auto-generate variant name from product name and selected options
                    $variantName = $this->name;
                    if (!empty($options) && is_array($options)) {
                        foreach ($options as $optionValue) {
                            if (is_array($optionValue)) {
                                // If options are nested arrays, flatten them
                                foreach ($optionValue as $val) {
                                    $variantName .= ' | ' . $val;
                                }
                            } else {
                                $variantName .= ' | ' . $optionValue;
                            }
                        }
                    }

                    $product->variants()->create([
                        'name' => $variantName,
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'options' => json_encode($options),
                        'photo' => $variantData['photo'] ?? null,
                        'is_default' => $variantData['is_default'] ?? false,
                        'is_active' => true,
                        'type' => 'product',
                    ]);
                }
            }

            DB::commit();

            $status = $this->published ? 'published' : 'saved as draft';
            session()->flash('success', "Product successfully {$status}!");
            $this->dispatch('productSaved');

            return redirect()->route('store.products', $this->store);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error creating product: ' . $e->getMessage());
            $this->dispatch('validationErrors');
            return false;
        }
    }

    public function render()
    {
        return view('livewire.store.product.product-create')
        ->extends('layouts.frontend.store.app')->section('content');
    }
}
