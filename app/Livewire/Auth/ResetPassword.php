<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.auth')]
class ResetPassword extends Component
{
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
