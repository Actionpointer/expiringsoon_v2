<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Http\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.frontend.customer.auth')]
class Signin extends Component
{
    use AuthTrait;

    
    public $email;
    public $password;
    public $remember = false;
    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function submit()
    {
        $this->validate();
        
        $result = $this->loginUser([
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);

        if (!$result['status']) {
            $this->errorMessage = $result['message'];
            return;
        }

        $this->dispatch('authenticated');
        // Successfully logged in
        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.signin');
    }
}
