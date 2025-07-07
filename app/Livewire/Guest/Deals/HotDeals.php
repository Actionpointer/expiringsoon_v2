<?php

namespace App\Livewire\Guest\Deals;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class HotDeals extends Component
{
    public function render()
    {
        return view('livewire.guest.deals.hot-deals');
    }
}
