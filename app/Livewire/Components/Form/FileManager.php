<?php

namespace App\Livewire\Components\Form;

use Livewire\Component;

class FileManager extends Component
{
    public $value = '';
    public $placeholder = '';
    public $wireModel = '';
    public $uniqueId;
    public $routePrefix;

    public function mount($value = '', $placeholder = '', $wireModel = '', $routePrefix = '')
    {
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->wireModel = $wireModel;
        $this->routePrefix = $routePrefix;
        $this->uniqueId = 'filemanager_' . uniqid();
    }

    public function updatedValue($value)
    {
        $this->dispatch('fileManagerValueUpdated', ['value' => $value, 'wireModel' => $this->wireModel]);
    }

    public function render()
    {
        return view('livewire.components.form.file-manager');
    }
} 