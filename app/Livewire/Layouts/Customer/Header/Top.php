<?php

namespace App\Livewire\Layouts\Customer\Header;

use App\Models\Cart;
use App\Models\City;
use App\Models\State;
use App\Models\Store;
use Livewire\Component;
use App\Models\Wishlist;
use Livewire\Attributes\On;
use App\Http\Traits\GeoLocationTrait;

class Top extends Component
{
    use GeoLocationTrait;
    
    public $loggedIn = false;
    public $search = '';
    public $current_location;
    public $states;
    public $wishlistCount = 0;
    public $cartCount = 0;
    public $notificationCount = 0;
    public $activeWorkplaces;
    
    
    public $showLocationModal = false;
    public $showCartModal = false;
    public $showWishlistModal = false;
    public $showNotificationModal = false;
    public $showWorkplaceModal = false;
    public $showLanguageModal = false;
    public $showCurrencyModal = false;
    

    protected $listeners = ['authenticated' => 'refresh'];

    public function setLocation($state_id)
    {
        $state = State::find($state_id);
        $this->current_location = collect(['state_id' => $state->id,'state_name' => $state->name,'country_code' => strtoupper($state->country->code), 'country_name' => $state->country->name,'country_id'=> $state->country_id]);
        session()->put('current_location', $this->current_location);
        $this->dispatch('closeModal', ['modalId' => 'locationModal']); 
        
    }

    public function mount()
    {
        $this->loggedIn = auth()->check();
        /*current location */
        if (session()->has('current_location')) {
            //get location from session
            $this->current_location = session('current_location');
        } else {
            //get location from ip
            $location = $this->getLocation();
            $this->current_location = collect(['state_id' => $location->state_id,'state_name' => $location->state,'country_code' => strtoupper($location->code), 'country_name' => $location->country,'country_id'=> $location->country_id]);
            session()->put('current_location', $this->current_location);
        }
        /*states in location */
        $this->states = State::where('country_id',$this->current_location['country_id'])->get();
        $this->cartCount = Cart::where('user_id', auth()->id())->count();
        if ($this->loggedIn) {
            $this->wishlistCount = Wishlist::where('user_id', auth()->id())->count();
            $this->notificationCount = auth()->user()->unreadNotifications()->count();
            $this->activeWorkplaces = auth()->user()->activeWorkplaces()->get();
        } else {
            $this->wishlistCount = 0;
            $this->notificationCount = 0;
        }
        
        
    }

    #[On('authenticated')]
    public function refresh()
    {
        $this->loggedIn = auth()->check();
        $this->activeWorkplaces = auth()->user()->activeWorkplaces()->get();
    }

    public function render()
    {
        return view('livewire.layouts.customer.header.top');
    }
}
