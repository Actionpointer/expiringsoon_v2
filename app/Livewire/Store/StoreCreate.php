<?php

namespace App\Livewire\Store;


use App\Models\City;
use App\Models\State;
use App\Models\Store;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Http\Traits\GeoLocationTrait;


class StoreCreate extends Component
{
    use GeoLocationTrait,WithFileUploads;
    protected $listeners = ['getStates', 'getCities'];

    public $location;
    public $countries;
    public $country_id;
    public $states = [];
    public $state_id;
    public $cities = [];
    public $city_id;
    public $name;
    public $email;
    public $phone;
    public $business_type;
    public $description;
    public $address;
    public $photo;
    public $terms;

    public function mount(){
        $this->countries = Country::all();
        $this->location = $this->getLocation();
        $this->country_id = $this->location->country_id;
        $this->state_id = $this->location->state_id;
        //dd($this->countries);
    }

    public function getStates($country_id)
    {
        $this->country_id = $country_id;
        $this->states = State::where('country_id', $this->country_id)->orderBy('name', 'asc')->get();
        $this->state_id = null; // Reset state selection
        $this->cities = []; // Reset cities
        $this->city_id = null; // Reset city selection
        $this->dispatch('states-updated', ['states' => $this->states]);
    }

    public function getCities($state_id)
    {
        $this->state_id = $state_id;
        $this->cities = City::where('state_id', $this->state_id)->orderBy('name', 'asc')->get();
        $this->city_id = null; // Reset city selection
        $this->dispatch('cities-updated', ['cities' => $this->cities]);
    }

    public function createStore(){
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'business_type' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'photo' => 'nullable|image|max:1024', // Max 1MB
            'terms' => 'required|accepted'
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('store/photos', 'public');
        }

        $store = Store::create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'business_type' => $this->business_type,
            'description' => $this->description,
            'address' => $this->address,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'photo' => $photoPath,
        ]);
        
        if($store){
            return redirect()->route('store.plans', $store);
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function render()
    {
        return view('livewire.store.store-create')->extends('layouts.frontend.store.app')->section('content');
    }
}
