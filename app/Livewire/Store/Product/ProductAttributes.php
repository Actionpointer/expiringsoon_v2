<?php

namespace App\Livewire\Store\Product;

use Livewire\Component;
use App\Models\ProductAttribute;

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

    public function handleAttributeChange($id, $value, $extra)
    {
        // Extract index from id, e.g., 'select2-single-1' => 1
        $index = (int) str_replace('select2-single-', '', $id);
        $this->selectedAttributes[$index] = [
            'value' => $value,
            'extra' => $extra,
        ];
        $this->emitAttributesChanged();

        // Build new options for select2-multiple using $extra
        $options = [];
        if (!empty($extra)) {
            $optionsArray = explode(',', $extra);
            foreach($optionsArray as $option) {
                $options[] = [
                    'value' => trim($option),
                    'label' => trim($option),
                    'extra' => '',
                ];
            }
        }
        $multipleId = 'select2-multiple-' . $index;
        $this->dispatch($multipleId, [
            'id' => $multipleId,
            'values' => $options,
            'selected' => $this->selectedOptions[$index] ?? []
        ]);
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
                    return $attr['slug'] === $attributeId['value'];
                });
                if ($currentAttribute) {
                    // Convert options string to array
                    $allOptions = [];
                    if (!empty($currentAttribute['options'])) {
                        $allOptions = array_map('trim', explode(',', $currentAttribute['options']));
                    }
                    $attributePayload[] = [
                        'id' => $attributeId['value'],
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