<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Dashboard')]
#[Layout('layouts.frontend.customer.dashboard')]
class DashboardPage extends Component
{
    public function render()
    {
        return view('livewire.customer.dashboard-page');
    }
}
