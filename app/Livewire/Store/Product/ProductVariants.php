<?php

namespace App\Livewire\Store\Product;

use App\Models\Product;
use Livewire\Component;

class ProductVariants extends Component
{
    public $variants = [];
    public $variantOptions = [];
    public $availableAttributes = [];
    public $routePrefix;

    protected function getListeners()
    {
        return [
            'initializeVariantSelects' => 'handleVariantSelects',
            'fileManagerValueUpdated' => 'handlePhotoChange',
            'saveVariants' => 'handleSaveVariants'
        ];
    }

    public function mount()
    {
        $this->routePrefix = route('store.filemanager', request()->store);
        $this->variants = [
            [
                'price' => '',
                'stock' => 0,
                'photo' => '',
                'options' => [],
                'is_default' => true
            ]
        ];
        $this->variantOptions = [];
    }

    public function addVariant()
    {
        $this->variants[] = [
            'price' => '',
            'stock' => 0,
            'photo' => '',
            'options' => [],
            'is_default' => false
        ];
        $this->variantOptions[] = [];
        $newIndex = count($this->variants) - 1;
        $this->dispatch('init-file-manager', ['index' => $newIndex]);
    }

    public function removeAttributeFromVariants($attributeId)
    {
        foreach ($this->variantOptions as $variantIndex => $options) {
            if (isset($this->variantOptions[$variantIndex][$attributeId])) {
                unset($this->variantOptions[$variantIndex][$attributeId]);
            }
        }
    }

    public function removeVariant($index)
    {
        if (count($this->variants) > 1) {
            unset($this->variants[$index]);
            $this->variants = array_values($this->variants);
            // Remove the corresponding options for this variant
            unset($this->variantOptions[$index]);
            $this->variantOptions = array_values($this->variantOptions);
        }
    }

    public function handleVariantSelects($attributesData)
    {
        $this->availableAttributes = $attributesData;
        // Sync variantOptions with available attributes
        $validAttributeIds = array_column($this->availableAttributes, 'id');
        foreach ($this->variantOptions as $variantIndex => $options) {
            foreach ($options as $attributeId => $value) {
                if (!in_array($attributeId, $validAttributeIds)) {
                    unset($this->variantOptions[$variantIndex][$attributeId]);
                }
            }
        }
    }

    public function variantOptionSelected($value,$id,$index){
        // Ensure the array exists for this variant
        if (!isset($this->variantOptions[$index])) {
            $this->variantOptions[$index] = [];
        }
        // Set or update the attribute value for this variant
        $this->variantOptions[$index][$id] = $value;
    }

    public function handlePhotoChange($value, $wireModel)
    {
        //dd($value, $wireModel);
        if (strpos($wireModel, 'variants.') === 0 && strpos($wireModel, '.photo') !== false) {
            $parts = explode('.', $wireModel);
            $index = (int) $parts[1];
            $this->variants[$index]['photo'] = $value;
        }
    }

    public function handleSaveVariants($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return;
        }

        // Ensure variants are not empty
        // if (empty($this->variants)) {
        //     $this->dispatch('notify', ['type' => 'error', 'message' => 'Please add at least one variant.']);
        //     return;
        // }

        // // Validate each variant
        // foreach ($this->variants as $i => $variantData) {
        //     if (empty($variantData['price']) || !is_numeric($variantData['price'])) {
        //         $this->dispatch('notify', ['type' => 'error', 'message' => "Variant {$i} must have a valid price."]);
        //         return;
        //     }
        //     if (!isset($variantData['stock']) || !is_numeric($variantData['stock'])) {
        //         $this->dispatch('notify', ['type' => 'error', 'message' => "Variant {$i} must have a valid stock quantity."]);
        //         return;
        //     }
        // }

        // // Save variants to the product
        // $this->saveVariantsToProduct($product);
        // $this->dispatch('notify', ['type' => 'success', 'message' => 'Variants saved successfully.']);


        if (!empty($this->variants)) {
            foreach ($this->variants as $i => $variantData) {
                $options = $this->variantOptions[$i] ?? [];
                $variantName = $product->name;
                if (!empty($options) && is_array($options)) {
                    foreach ($options as $optionValue) {
                        if (is_array($optionValue)) {
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
                    'is_default' => $i === 0 ? true : false,
                    'is_active' => true,
                    'type' => 'product',
                ]);
            }
        }
    }


    public function render()
    {
        return view('livewire.store.product.product-variants');
    }
} 