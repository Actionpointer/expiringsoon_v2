<?php

namespace App\Livewire\Customer\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.dashboard')]
class SingleOrder extends Component
{
    public function render()
    {
        return view('livewire.customer.orders.single-order');
    }
}
