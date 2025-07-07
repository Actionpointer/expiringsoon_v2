<?php

namespace App\Livewire\Guest\Compare;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class ComparePage extends Component
{
    public function render()
    {
        return view('livewire.guest.compare.compare-page');
    }
}
