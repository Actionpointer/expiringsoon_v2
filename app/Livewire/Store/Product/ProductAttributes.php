<?php

namespace App\Livewire\Store\Product;

use Livewire\Component;
use App\Models\ProductAttribute;
use Illuminate\Support\Collection;

class ProductAttributes extends Component
{
    public $selectedAttributes = [];
    public $selectedOptions = [];
    public $productAttributes = [];

    protected function getListeners()
    {
        return [
            'select2ValueUpdated' => 'handleAttributeChange',
            'select2MultipleValuesUpdated' => 'handleOptionsChange'
        ];
    }

    public function mount()
    {
        $this->productAttributes = ProductAttribute::all()->toArray();
        $this->selectedAttributes = [''];
        $this->selectedOptions = [[]];
        //dd($this->productAttributes);
    }

    public function addAttributeRow()
    {
        $this->selectedAttributes[] = '';
        $this->selectedOptions[] = [];
    }

    public function removeAttributeRow($index)
    {
        if (count($this->selectedAttributes) > 1) {
            unset($this->selectedAttributes[$index]);
            unset($this->selectedOptions[$index]);
            $this->selectedAttributes = array_values($this->selectedAttributes);
            $this->selectedOptions = array_values($this->selectedOptions);
            $this->emitAttributesChanged();
        }
    }

    public function handleAttributeChange($value, $wireModel)
    {
        if (strpos($wireModel, 'selected_attributes.') === 0) {
            $index = (int) str_replace('selected_attributes.', '', $wireModel);
            $this->selectedAttributes[$index] = $value;
            $this->emitAttributesChanged();
        }
    }

    public function handleOptionsChange($values, $wireModel)
    {
        if (strpos($wireModel, 'selected_options.') === 0) {
            $index = (int) str_replace('selected_options.', '', $wireModel);
            $this->selectedOptions[$index] = $values ?? [];
            $this->emitAttributesChanged();
        }
    }

    public function emitAttributesChanged()
    {
        $attributePayload = [];
        foreach ($this->selectedAttributes as $index => $attributeId) {
            if (!empty($attributeId)) {
                $currentAttribute = collect($this->productAttributes)->first(function($attr) use ($attributeId) {
                    return $attr['slug'] === $attributeId;
                });
                if ($currentAttribute) {
                    // Convert options string to array
                    $allOptions = [];
                    if (!empty($currentAttribute['options'])) {
                        $allOptions = array_map('trim', explode(',', $currentAttribute['options']));
                    }
                    $attributePayload[] = [
                        'id' => $attributeId,
                        'name' => $currentAttribute['name'],
                        'options' => $allOptions, // send all possible options
                        'selected_options' => $this->selectedOptions[$index], // optionally, send selected
                    ];
                }
            }
        }
        $this->dispatch('attributesChanged', ['attributes' => $attributePayload]);
    }

    public function render()
    {
        return view('livewire.store.product.product-attributes');
    }
} 