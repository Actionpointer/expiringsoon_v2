<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.dashboard')]
class WishlistPage extends Component
{
    public function render()
    {
        return view('livewire.customer.wishlist-page');
    }
}
