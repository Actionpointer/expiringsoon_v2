<?php

namespace App\Livewire\Guest\Stores;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class AllStores extends Component
{
    public function render()
    {
        return view('livewire.guest.stores.all-stores');
    }
}
