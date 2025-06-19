<?php

namespace App\Livewire\Components\Form;

use Livewire\Component;

class Select2Multiple extends Component
{
    public $values = [];
    public $options = [];
    public $placeholder = '';
    public $wireModel = '';
    public $uniqueId;

    public function mount($values = [], $options = [], $placeholder = '', $wireModel = '')
    {
        $this->values = is_array($values) ? $values : [];
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->wireModel = $wireModel;
        $this->uniqueId = 'select2_multiple_' . uniqid();
    }

    public function updatedValues($values)
    {
        $this->dispatch('select2MultipleValuesUpdated', ['values' => $values, 'wireModel' => $this->wireModel]);
    }

    public function render()
    {
        return view('livewire.components.form.select2-multiple');
    }
} 