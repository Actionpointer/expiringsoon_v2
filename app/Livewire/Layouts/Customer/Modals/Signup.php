<?php

namespace App\Livewire\Layouts\Customer\Modals;

use Livewire\Component;
use App\Http\Traits\AuthTrait;

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
            $this->errorMessage = $result['message'];
        } else {
            auth()->login($result['user']);
            // Only on success: reset form, refresh icons, and close modal
            $this->reset(['firstname', 'surname', 'email', 'password', 'errorMessage']);
            $this->dispatch('authenticated');
            $this->dispatch('closeModal', ['modalId' => 'signUpModal']);   
        }
        
    }

    public function render()
    {
        return view('livewire.layouts.customer.modals.signup');
    }
}
