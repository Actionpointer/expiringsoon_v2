<?php

namespace App\Livewire\Customer;

use Livewire\Component;

#[Layout('layouts.frontend.customer.app')]
class CheckoutPage extends Component
{
    public function render()
    {
        return view('livewire.customer.checkout-page');
    }
}
