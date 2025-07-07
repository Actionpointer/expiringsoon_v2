<?php

namespace App\Livewire\Customer\Address;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.dashboard')]
class AddressPage extends Component
{
    public function render()
    {
        return view('livewire.customer.address.address-page');
    }
}
