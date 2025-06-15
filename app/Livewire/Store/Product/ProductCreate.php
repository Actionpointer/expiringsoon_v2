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
            'description' => 'required|min:10',
            'meta_description' => 'nullable|max:255',
            'photos' => 'nullable|string',
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

    // protected function rebuildSelectedAttributePayload()
    // {
    //     $this->selected_attributes_payload = [];

    //     foreach ($this->selected_attributes as $index => $attributeId) {
    //         if (!isset($this->selected_options[$index])) continue;

    //         $attribute = ProductAttribute::find($attributeId);
    //         if (!$attribute) continue;

    //         $this->selected_attributes_payload[] = [
    //             'attribute_id' => $attribute->id,
    //             'attribute_name' => $attribute->name,
    //             'options' => $this->selected_options[$index],
    //         ];
    //     }
    // }
    
    protected $messages = [
        'category_id.required' => 'Please select a category',
        'photos.required' => 'Please provide at least one product image URL',
        'expire_at.required_if' => 'Expiry date is required when the product is not always available',
        'expire_at.after' => 'Expiry date must be after today',
        'variants.*.price.required' => 'Price is required for all variants',
        'variants.*.stock.required' => 'Stock quantity is required for all variants',
    ];

    // public function updatedImage()
    // {
    //     // Handle direct uploads if needed
    //     $this->validate(['image' => 'image|max:2048']);
    // }
    

    #[On('attributesCollected')]
    public function updateSelectedAttributes( $detail)
    {
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

    // public function selectFromFileManager($path)
    // {
    //     $this->photoPath = $path;
    //     $this->dispatchBrowserEvent('image-selected', ['path' => $path]);
    // }
    /*
    public function updatedAlwaysAvailable()
    {
        if ($this->always_available) {
            $this->expire_at = null;
        } else {
            $this->expire_at = now()->addMonths(3)->format('Y-m-d');
        }
    }
    
    public function updatedHasVariants($value)
    {
        if (!$value && count($this->variants) > 1) {
            // Keep only the first variant if variants are disabled
            $this->variants = [$this->variants[0]];
        }
    }
    
    public function addVariant()
    {
        $this->variants[] = [
            'price' => '',
            'stock' => 0,
            'options' => [],
            'is_default' => count($this->variants) === 0, // First variant is default
        ];
        
        // Generate names for all variants based on current options
        $this->updateVariantNames();
    }
    
    public function removeVariant($index)
    {
        // Don't remove if it's the only variant
        if (count($this->variants) <= 1) {
            return;
        }
        
        // Check if we're removing the default variant
        $wasDefault = isset($this->variants[$index]['is_default']) && $this->variants[$index]['is_default'];
        
        // Remove the variant
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
        
        // If we removed the default variant, set the first one as default
        if ($wasDefault && count($this->variants) > 0) {
            $this->variants[0]['is_default'] = true;
        }
        
        // Update variant names
        $this->updateVariantNames();
    }
    
    public function setDefaultVariant($index)
    {
        foreach ($this->variants as $key => $variant) {
            $this->variants[$key]['is_default'] = ($key == $index);
        }
    }
    
    public function updateVariantNames()
    {
        // Get attribute information for name generation
        $attributeInfo = [];
        foreach ($this->selected_attributes as $index => $attributeId) {
            if (!empty($attributeId)) {
                // Use firstWhere to ensure we get a single model, not a collection
                $prd_attribute = ProductAttribute::where('id', $attributeId)->first();
                if ($prd_attribute) {
                    $attributeInfo[$attributeId] = [
                        'name' => $prd_attribute->name,
                        'options' => isset($this->selected_options[$index]) ? $this->selected_options[$index] : []
                    ];
                }
            }
        }
        
        // Update each variant name based on its options
        foreach ($this->variants as $index => $variant) {
            $nameParts = [];
            
            if (isset($variant['options']) && is_array($variant['options'])) {
                foreach ($variant['options'] as $attrId => $optionValue) {
                    if (!empty($optionValue) && isset($attributeInfo[$attrId])) {
                        $nameParts[] = $optionValue;
                    }
                }
            }
            
            // Generate variant name based on product name and options
            if (!empty($nameParts)) {
                $this->variants[$index]['name'] = $this->name . ' - ' . implode(' ', $nameParts);
            } else {
                $this->variants[$index]['name'] = $this->name . ' - Variant ' . ($index + 1);
            }
        }
    }
    
    public function updatedName()
    {
        // When the product name changes, update all variant names
        $this->updateVariantNames();
    }
    */
    // #[On('photoSelected')]
    // public function getPhotoArrayAttribute($payload)
    // {
    //     $this->photos = $payload['url'] ?? null;
        
    //     return explode(',', $this->photos);
    // }

    // #[On('variantNameUpdated')]
    // public function updateVariantName($payload)
    // {
    //     $this->variants[$payload['index']]['name'] = $payload['name'];
    // }
    
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


        // Validate and prepare data
        Log::info('Photos value:', [$this->photos]);
        
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

            // Save variants
            $createdVariants = [];
            foreach ($this->variants as $variantData) {
                $variantPayload = [
                    'name'       => $product->name,
                    'price'      => $variantData['price'],
                    'stock'      => $variantData['stock'],
                    'options'    => json_encode($variantData['options'] ?? []),
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

            return $redirect
                ? redirect()->route('store.products', $this->store)
                : true;

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
