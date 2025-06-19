<?php

namespace App\Livewire\Store\Product;

use Livewire\Component;

class ProductVariants extends Component
{
    public $variants = [];
    public $selectedAttributes = [];
    public $routePrefix;

    protected function getListeners()
    {
        return [
            'attributesChanged' => 'handleAttributesChanged',
            'fileManagerValueUpdated' => 'handlePhotoChange',
            'getVariantData' => 'sendVariantData'
        ];
    }

    public function mount($routePrefix = '')
    {
        $this->routePrefix = $routePrefix;
        $this->variants = [
            [
                'price' => '',
                'stock' => 0,
                'photo' => '',
                'options' => [],
                'is_default' => true
            ]
        ];
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
    }

    public function removeVariant($index)
    {
        if (count($this->variants) > 1) {
            unset($this->variants[$index]);
            $this->variants = array_values($this->variants);
        }
    }

    public function handleAttributesChanged($attributesData)
    {
        $this->selectedAttributes = $attributesData;
        $this->dispatch('variantsAttributesChanged', ['attributes' => $this->selectedAttributes]);
    }

    public function handlePhotoChange($value, $wireModel)
    {
        if (strpos($wireModel, 'variants.') === 0 && strpos($wireModel, '.photo') !== false) {
            $parts = explode('.', $wireModel);
            $index = (int) $parts[1];
            $this->variants[$index]['photo'] = $value;
        }
    }

    public function sendVariantData()
    {
        $this->dispatch('variantDataReceived', ['variants' => $this->variants]);
    }

    public function getVariantData()
    {
        return $this->variants;
    }

    public function render()
    {
        return view('livewire.store.product.product-variants');
    }
} 