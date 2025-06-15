<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.customer.dashboard')->layout('layouts.frontend.customer.dashboard');
    }
}
