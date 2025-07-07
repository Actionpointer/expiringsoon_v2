<?php

namespace App\Livewire\Guest\Carts;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class CartPage extends Component
{
    public function render()
    {
        return view('livewire.guest.carts.cart-page');
    }
}
