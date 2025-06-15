<?php

namespace App\Livewire\Store;


use App\Models\City;
use App\Models\Role;
use App\Models\State;
use App\Models\Store;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Traits\GeoLocationTrait;
use App\Notifications\StoreNotifications\NewStoreNotification;


class StoreCreate extends Component
{
    use GeoLocationTrait,WithFileUploads;
    protected $listeners = ['getStates', 'getCities', 'setCityId'];

    public $location;
    public $countries;
    public $country_id;
    public $states = [];
    public $state_id;
    public $cities = [];
    public $city_id;
    public $zip_code;
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
        // $this->location = $this->getLocation();
        // $this->country_id = $this->location->country_id;
        // $this->state_id = $this->location->state_id;
        //dd($this->countries);
    }

    public function getStates($country_id)
    {
        $this->country_id = $country_id;
        $this->states = State::where('country_id', $this->country_id)->orderBy('name', 'asc')->get();
        $this->state_id = null; // Reset state selection
        $this->cities = []; // Reset cities
        // $this->city_id = null; // Reset city selection
        $this->dispatch('states-updated', ['states' => $this->states]);
    }

    public function getCities($state_id)
    {
        $this->state_id = $state_id;
        $this->cities = City::where('state_id', $this->state_id)->orderBy('name', 'asc')->get();
        // $this->city_id = null; // Reset city selection
        $this->dispatch('cities-updated', ['cities' => $this->cities]);
    }
<<<<<<< HEAD
    
=======

>>>>>>> 9ce005d64c7ad61b6f8886542add6622fd6b76c4
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }

<<<<<<< HEAD
    public function createStore(){       
=======
    public function createStore(){
>>>>>>> 9ce005d64c7ad61b6f8886542add6622fd6b76c4
        //dd($this->all());
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'business_type' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'zip_code' => 'required|string',
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
            'zip_code' => $this->zip_code,
            'photo' => $photoPath,
        ]);

        $role = Role::where('slug','store_owner')->first();
        $store->staff()->attach(auth()->id(), [
            'permissions' => $role->permissions,'role_id'=> $role->id,
            'status' => 'active'
        ]);
        // $store->owner->notify(new NewStoreNotification($store));
        
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
