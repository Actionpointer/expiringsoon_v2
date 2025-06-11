<?php

namespace App\Livewire\Layouts\Store;

use App\Models\Store;
use Livewire\Component;

class Sidemenu extends Component
{
    public $store;

    public function mount()
    {
        $this->store = request()->store;
    }
    public function render()
    {
        return view('livewire.layouts.store.sidemenu');
    }
}
