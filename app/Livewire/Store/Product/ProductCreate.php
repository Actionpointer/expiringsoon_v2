<?php

namespace App\Livewire\Store\Product;

use Carbon\Carbon;
use App\Models\Store;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
// use App\Models\ProductAttribute;
use App\Models\ProductAttribute;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class ProductCreate extends Component
{
    public  $store;
    
    // Basic product information
    public $name = '';
    public $description = '';
    public $meta_description = '';
    public $photos;
    public $photoPath;
    public $photoArray = [];
    public $categories = [];
    public $category_id = [];
    public $product_attributes = [];
   
    public $selected_attributes = [];
    public $selected_options = [];


    // Product availability
    public bool $preorder = false;
    public bool $always_available = false;
    public $expire_at = '';
    public $expiry_term = '';
    
    // Discount settings
    public $discount30 = '';
    public $discount60 = '';
    public $discount90 = '';
    public $discount120 = ''; 
    public $product_options = [];
    
    // Product status
    public $published = false;
    
    // Variant information
    public $hasVariants = false;
    public $variants = [];
    
    // protected $listeners = ['variantOptionsUpdated' => 'updateVariantNames'];
    
    public function mount($store)
    {
        $this->discount30 = 29;
        $this->store = $store;
        $this->expire_at = now()->addMonths(3)->format('Y-m-d');
        $this->product_attributes = ProductAttribute::all();
        $this->product_options = ProductOption::all();
        $this->categories = Category::all();
        // $this->selected_options[] = [];
        // Initialize with one empty variant
        $this->variants = [
            [
                'name' => '',
                'price' => '',
                'stock' => 0,
                'options' => [],
                'is_default' => true
            ]
        ];
    }
    
    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            // 'description' => 'required|min:10',
            // 'meta_description' => 'nullable|max:255',
            'photos' => 'nullable|string',
            'category_id' => 'required',
            'preorder' => 'boolean',
            'always_available' => 'boolean',
            'expire_at' => 'required_if:always_available,false|nullable|date|after:today',
            // 'expiry_term' => 'nullable|string',
            // 'discount30' => 'required|numeric|min:0',
            // 'discount60' => 'required|numeric|min:0',
            // 'discount90' => 'required|numeric|min:0',
            // 'discount120' => 'required|numeric|min:0',
            // 'published' => 'boolean',
            
            'hasVariants' => 'boolean',
            'variants' => 'required|array|min:1',
            // 'variants.*.name' => 'required',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.options' => 'nullable',
            'selected_attributes' => 'nullable|array',
        ];
    }


     public function updatedSelectedAttributes($value, $key)
    {
        // Re-map to build attribute: options payload if needed
        $this->rebuildSelectedAttributePayload();
    }

    public function updatedSelectedOptions($value, $key)
    {
        $this->rebuildSelectedAttributePayload();
    }

 
    
    protected $messages = [
        'category_id.required' => 'Please select a category',
        'photos.required' => 'Please provide at least one product image URL',
        'expire_at.required_if' => 'Expiry date is required when the product is not always available',
        'expire_at.after' => 'Expiry date must be after today',
        'variants.*.price.required' => 'Price is required for all variants',
        'variants.*.stock.required' => 'Stock quantity is required for all variants',
    ];


    #[On('attributesCollected')]
    public function updateSelectedAttributes( $detail)
    {
        // $this->generateVariants();

        $attributes = isset($detail['detail']) ? $detail['detail'] : $detail;
        $this->selected_attributes = $detail;
        Log::info('Raw attributesCollected payload:', ['detail' => $detail]);


        $normalizedAttributes = [];
        foreach ($attributes as $attributeName => $data) {
            if (isset($data['id'], $data['options']) && is_array($data['options'])) {
                $normalizedAttributes[] = [
                    'name' => $attributeName,
                    'id' => $data['id'],
                    'options' => $data['options'],
                ];
            } else {
                Log::warning('Invalid attribute structure:', ['attribute' => $data]);
            }
        }

        Log::info('Normalized attributesCollected payload:', ['payload' => $normalizedAttributes]);
        $this->selected_attributes = $normalizedAttributes;
    }

    public function generateVariants()
    {
        $this->variants = [];

        if (!empty($this->selectedAttributes)) {
            $combinations = $this->getCombinations(array_values($this->selectedAttributes));

            foreach ($combinations as $combo) {
                $variantKey = implode('-', $combo);
                $this->variants[] = [
                    'attributes' => $combo,
                    'price' => null,
                    'stock' => null,
                ];
            }
        }
    }

    public function saveAsDraft()
    {
        // Temporarily set published to false
        $originalPublishedState = $this->published;
        $this->published = false;
        
        // Save the product
        $result = $this->saveProduct(false);
        
        // Restore original published state
        $this->published = $originalPublishedState;
        
        return $result;
    }

    #[On('categoryUpdated')]
    public function updatedCategory( $value) 
    {
        
       // If $value is an object with a `data` key, use it (for array dispatch)
        if (is_array($value) && isset($value['data'])) {
            $this->category_id = $value['data'][0] ?? null;
        }
        // Otherwise, treat it as a single value
        else {
            $this->category_id = $value;
        }

    }
    
    public function saveProduct($redirect = true)
    {
        $storeId = auth()->user()->stores->first()->id;

        // dd($this->category_id, $this->selected_attributes, $this->variants);
        // Validate and prepare data
        
        // Build attribute-option pairs
        $attributesData = [];
        foreach ($this->selected_attributes as $attribute) {
            if (!empty($attribute['id']) && !empty($attribute['options'])) {
                $attributesData[$attribute['id']] = $attribute['options'];
            }
        }

        try {
            try {
                $this->validate();
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::error('Validation failed', [
                    'errors' => $e->validator->errors()->toArray(),
                ]);
                throw $e; // or return false
            }

            DB::beginTransaction();

            // Create product
            try {
                $productData = [
                    'store_id'         => $storeId,
                    'category_id'      => $this->category_id,
                    'name'             => $this->name,
                    'slug'             => Str::slug($this->name),
                    'description'      => $this->description,
                    'meta_description' => $this->meta_description,
                    'photos'           => $this->photos ? json_encode(explode(',', $this->photos)) : json_encode([]),
                    'preorder'         => $this->preorder,
                    'always_available' => $this->always_available,
                    'expire_at'        => $this->always_available ? null : Carbon::parse($this->expire_at),
                    'expiry_term'      => $this->expiry_term,
                    'discount30'       => $this->discount30,
                    'discount60'       => $this->discount60,
                    'discount90'       => $this->discount90,
                    'discount120'      => $this->discount120,
                    'published'        => $this->published,
                ];

                $product = new Product($productData);
              
                $product->save();

                Log::info('Product created successfully', [
                    'product_id' => $product->id,
                    'data'       => $productData,
                ]);

            } catch (\Throwable $e) {
                Log::error('Error creating product', [
                    'message' => $e->getMessage(),
                    'trace'   => $e->getTraceAsString(),
                    'data'    => $productData ?? [],
                ]);

                throw $e; // Optional: rethrow if you want to halt execution
            }


            
            // Save variants $dd()
            $createdVariants = [];
            foreach ($this->variants as $variantData) {
                $variantPayload = [
                    'name'       => $product->name,
                    'price'      => $variantData['price'],
                    'stock'      => $variantData['stock'],
                    'options'    => $variantData['options'],
                    'is_default' => $variantData['is_default'] ?? false,
                    'is_active'  => true,
                ];
                try {
                    $variant = $product->variants()->create($variantPayload);
                    Log::info('Variant created', ['id' => $variant->id, 'payload' => $variantPayload]);
                } catch (\Throwable $e) {
                    Log::error('Error creating variant', [
                        'message' => $e->getMessage(),
                        'payload' => $variantPayload,
                    ]);
                }
            }
            Log::info('Created product variants:', $createdVariants);
        
            // Save product attributes and options
            $createdOptions = [];

            foreach ($attributesData as $attributeId => $optionValues) {
                $optionPayload = [
                    'product_attribute_id' => $attributeId,
                    'values'               => $optionValues,
                ];

                // Save to DB
                $product->options()->create($optionPayload);
            }

            // Log all options created
            Log::info('Created product options:', $createdOptions);

            
            DB::commit();

            // Notify success
            $status = $this->published ? 'published' : 'saved as draft';
            session()->flash('success', "Product successfully {$status}!");
            $this->dispatch('productSaved');

            return $redirect ? redirect()->route('store.products', $this->store) : true;

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error creating product: ' . $e->getMessage());
            $this->dispatch('validationErrors');
            return false;
        }
        
    }

    public function getCategoriesProperty()
    {
        return Category::where('is_active', true)
            ->orderBy('name')
            ->get();
    }
    
    public function render()
    {
        return view('livewire.store.product.product-create')
        ->extends('layouts.frontend.store.app')->section('content');
    }
}

