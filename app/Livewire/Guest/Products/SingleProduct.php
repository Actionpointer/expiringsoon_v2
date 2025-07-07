<?php

namespace App\Livewire\Guest\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class SingleProduct extends Component
{
    public function render()
    {
        return view('livewire.guest.products.single-product');
    }
}
