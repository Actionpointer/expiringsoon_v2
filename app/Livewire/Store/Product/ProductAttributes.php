<?php

namespace App\Livewire\Store\Product;

use Livewire\Component;
use App\Models\ProductOption;
use App\Models\ProductAttribute;

class ProductAttributes extends Component
{
    public $attributeRows = [];
    public $selectedOptions = [];
    public $productAttributes = [];

    protected function getListeners()
    {
        return [
            'select2ValueUpdated' => 'handleSelect2AttributeChange',
            'select2MultipleValuesUpdated' => 'handleSelect2MultipleOptionsChange',
            'saveAttributes' => 'handleAttributesSave'
        ];
    }

    public function mount()
    {
        $this->productAttributes = ProductAttribute::all()->toArray();
        $this->attributeRows = [['value' => '', 'extra' => '']];
        $this->selectedOptions = [[]];
        //dd($this->productAttributes);
    }

    public function addAttributeRow()
    {
        $this->attributeRows[] = ['value' => '', 'extra' => ''];
        $this->selectedOptions[] = [];
        $newIndex = count($this->attributeRows) - 1;
        $this->dispatch('init-select2-row', ['index' => $newIndex]);
    }

    public function removeAttributeRow($index)
    {
        if (count($this->attributeRows) > 1) {
            unset($this->attributeRows[$index]);
            unset($this->selectedOptions[$index]);
            $this->attributeRows = array_values($this->attributeRows);
            $this->selectedOptions = array_values($this->selectedOptions);
            $this->generateVariantSelectOptions();
        }
    }

    public function handleSelect2AttributeChange($id, $value, $extra)
    {
        $index = (int) str_replace('select2-single-', '', $id);
        $this->attributeRows[$index] = [
            'value' => $value,
            'extra' => $extra,
        ];
        //$this->generateVariantSelectOptions();

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
        $this->dispatch('updateSelectMultipleOptions', [
            'id' => $multipleId,
            'values' => $options,
            'selected' => $this->selectedOptions[$index] ?? []
        ]);
        
    }

    public function handleSelect2MultipleOptionsChange($id, $values)
    {
        $index = (int) str_replace('select2-multiple-', '', $id);
        $this->selectedOptions[$index] = $values ?? [];
        $this->generateVariantSelectOptions();
    }

    public function generateVariantSelectOptions()
    {
        $attributePayload = [];
        foreach ($this->attributeRows as $index => $selectedAttribute) {
            if (!empty($selectedAttribute)) {
                $currentAttribute = collect($this->productAttributes)->first(function($attr) use ($selectedAttribute) {
                    return $attr['slug'] === $selectedAttribute['value'];
                });
                if ($currentAttribute) {
                    $attributePayload[] = [
                        'id' => $selectedAttribute['value'], //the actual value selected e.g color
                        'name' => $currentAttribute['name'], //e.g Color
                        'options' => $this->selectedOptions[$index], // optionally, send selected
                        'selected' => ''
                    ];
                    //dd($attributePayload);
                }
            }
        }
        $this->dispatch('initializeVariantSelects', $attributePayload);
    }

    public function handleAttributesSave($product_id)
    {
        foreach($this->attributeRows as $key => $attributeRow){
            $singleAttribute = collect($this->productAttributes)->first(function($attr) use ($attributeRow) {
                return $attr['slug'] === $attributeRow['value'];
            });
            if ($singleAttribute) {
                ProductOption::create([
                    'product_id' => $product_id,
                    'product_attribute_id' => $singleAttribute['id'],
                    'values' => json_encode($this->selectedOptions[$key])
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.store.product.product-attributes');
    }
} 