<?php

namespace App\Livewire\Components\Form;

use Livewire\Component;

class Select2Single extends Component
{
    /**
     * @var array<int, array{value: mixed, label: string, extra?: mixed}>
     */
    public $options = [];
    public $value = '';
    public $placeholder = '';
    public $wireModel = '';
    public $uniqueId;

    public function mount($value = '', $options = [], $placeholder = '', $wireModel = '')
    {
        $this->value = $value;
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->wireModel = $wireModel;
        // $this->uniqueId = $uniqueId ?? 'select2_single_' . uniqid();
    }

    // public function updatedValue($value)
    // {
    //     $this->dispatch('select2ValueUpdated', ['value' => $value, 'wireModel' => $this->wireModel]);
    // }

    public function render()
    {
        return view('livewire.components.form.select2-single');
    }
} 