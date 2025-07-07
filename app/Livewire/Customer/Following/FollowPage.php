<?php

namespace App\Livewire\Customer\Following;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.dashboard')]
class FollowPage extends Component
{
    public function render()
    {
        return view('livewire.customer.following.follow-page');
    }
}
