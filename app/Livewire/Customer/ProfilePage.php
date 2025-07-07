<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Profile')]
#[Layout('layouts.frontend.customer.dashboard')]
class ProfilePage extends Component
{
    public function render()
    {
        return view('livewire.customer.profile-page');
    }
}
