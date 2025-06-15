<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class Welcome extends Component
{

    public function render()
    {
        return view('livewire.guest.welcome');
    }
}
