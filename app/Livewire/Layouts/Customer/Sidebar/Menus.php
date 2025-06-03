<?php

namespace App\Livewire\Layouts\Customer\Sidebar;

use Livewire\Component;
use App\Http\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;

class Menus extends Component
{
    use AuthTrait;

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('welcome');
    }
    
    public function render()
    {
        return view('livewire.layouts.customer.sidebar.menus');
    }
}
