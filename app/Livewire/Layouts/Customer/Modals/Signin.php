<?php

namespace App\Livewire\Layouts\Customer\Modals;

use Livewire\Component;
use App\Http\Traits\AuthTrait;

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
        
            // Then attempt login
        $result = $this->loginUser([
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
        ]);
        
        if (!$result['status']) {
            $this->errorMessage = $result['message'];
        } else {
            // Only on success: reset form, refresh icons, and close modal
            $this->reset(['email', 'password', 'errorMessage']);
            $this->dispatch('authenticated');
            $this->dispatch('closeModal', ['modalId' => 'signInModal']);   
        }
        
    }
    

    public function render()
    {
        return view('livewire.layouts.customer.modals.signin');
    }
}
