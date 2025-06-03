<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Http\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.frontend.customer.auth')]
class Signup extends Component
{
    use AuthTrait;

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $password_confirmation;
    public $errorMessage = '';

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required'
    ];

    public function signup()
    {
        $this->validate();
        
        $result = $this->registerUser([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        if (!$result['status']) {
            if (isset($result['errors'])) {
                $this->errorMessage = collect($result['errors']->all())->implode('<br>');
            } else {
                $this->errorMessage = $result['message'];
            }
            return;
        }

        // Log the user in automatically
        Auth::login($result['user']);
        
        // Redirect to dashboard
        return redirect()->intended(route('dashboard'));
    }
    
    public function render()
    {
        return view('livewire.auth.signup');
    }
}
