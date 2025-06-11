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

    public $firstname;
    public $surname;
    public $email;
    public $password;
    public $errorMessage = '';

    protected $rules = [
        'firstname' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8',
    ];

    public function submit()
    {
        $this->validate();
        
        $result = $this->registerUser([
            'firstname' => $this->firstname,
            'surname' => $this->surname,
            'email' => $this->email,
            'password' => $this->password,
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
