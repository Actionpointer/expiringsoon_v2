<?php

namespace App\Livewire\Store;

use App\Models\Store;
use Livewire\Component;
use Livewire\Attributes\Layout;

// #[Layout('layouts.frontend.store.app')]
class StoreDashboard extends Component
{
    

    public Store $store;
    

    public function mount($store)
    {
        $this->store = $store;
        
    }
    public function render()
    {
        return view('livewire.store.store-dashboard')
        ->extends('layouts.frontend.store.app',[
            'store' => $this->store
        ])->section('content');
    }
}
