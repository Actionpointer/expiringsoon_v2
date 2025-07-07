<?php

namespace App\Livewire\Store\Settings;

use App\Models\Store;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StoreDetails extends Component
{
    use WithFileUploads;

    public Store $store;
    
    // Form properties
    public $name;
    public $legal_business_name;
    public $email;
    public $phone;
    public $description;
    public $contact_person;
    public $alt_contact_phone;
    public $country_id;
    public $state_id;
    public $city_id;
    public $zip_code;
    public $address;
    public $website;
    public $facebook;
    public $instagram;
    public $twitter;
    public $business_type;
    public $tax_id;
    public $business_registration_number;
    public $year_established;
    
    // File uploads
    public $logo;
    public $banner;
    
    // Location data
    public $countries;
    public $states = [];
    public $cities = [];

    public function mount($store){
        $this->store = $store;
        $this->loadStoreData();
        $this->loadLocationData();
    }

    public function loadStoreData()
    {
        $this->name = $this->store->name;
        $this->legal_business_name = $this->store->legal_business_name;
        $this->email = $this->store->email;
        $this->phone = $this->store->phone;
        $this->description = $this->store->description;
        $this->contact_person = $this->store->contact_person;
        $this->alt_contact_phone = $this->store->alt_contact_phone;
        $this->country_id = $this->store->country_id;
        $this->state_id = $this->store->state_id;
        $this->city_id = $this->store->city_id;
        $this->zip_code = $this->store->zip_code;
        $this->address = $this->store->address;
        $this->website = $this->store->website;
        $this->facebook = $this->store->facebook;
        $this->instagram = $this->store->instagram;
        $this->twitter = $this->store->twitter;
        $this->business_type = $this->store->business_type;
        $this->tax_id = $this->store->tax_id;
        $this->business_registration_number = $this->store->business_registration_number;
        $this->year_established = $this->store->year_established;
    }

    public function loadLocationData()
    {
        $this->countries = Country::all();
        
        if ($this->country_id) {
            $this->states = State::where('country_id', $this->country_id)->get();
        }
        
        if ($this->state_id) {
            $this->cities = City::where('state_id', $this->state_id)->get();
        }
    }

    public function updatedCountryId($value)
    {
        $this->state_id = null;
        $this->city_id = null;
        $this->states = State::where('country_id', $value)->get();
        $this->cities = [];
    }

    public function updatedStateId($value)
    {
        $this->city_id = null;
        $this->cities = City::where('state_id', $value)->get();
    }

    public function removeLogo()
    {
        if ($this->store->photo) {
            Storage::disk('public')->delete($this->store->photo);
            $this->store->update(['photo' => null]);
        }
    }

    public function removeBanner()
    {
        if ($this->store->banner) {
            Storage::disk('public')->delete($this->store->banner);
            $this->store->update(['banner' => null]);
        }
    }

    public function saveStoreSettings()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'legal_business_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:stores,email,' . $this->store->id,
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string|max:1000',
            'contact_person' => 'nullable|string|max:255',
            'alt_contact_phone' => 'nullable|string|max:20',
            'country_id' => 'required|exists:sqlite_countries.countries,id',
            'state_id' => 'required|exists:sqlite_states.states,id',
            'city_id' => 'required|exists:sqlite_cities.cities,id',
            'zip_code' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'business_type' => 'required|in:individual,business',
            'tax_id' => 'nullable|string|max:50',
            'business_registration_number' => 'nullable|string|max:100',
            'year_established' => 'nullable|integer|min:1900|max:' . date('Y'),
            'logo' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'banner' => 'nullable|image|max:3072|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'name' => $this->name,
            'legal_business_name' => $this->legal_business_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'description' => $this->description,
            'contact_person' => $this->contact_person,
            'alt_contact_phone' => $this->alt_contact_phone,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'zip_code' => $this->zip_code,
            'address' => $this->address,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'business_type' => $this->business_type,
            'tax_id' => $this->tax_id,
            'business_registration_number' => $this->business_registration_number,
            'year_established' => $this->year_established,
        ];

        // Handle logo upload
        if ($this->logo) {
            if ($this->store->photo) {
                Storage::disk('public')->delete($this->store->photo);
            }
            $logoPath = $this->logo->store('stores/logos', 'public');
            $data['photo'] = $logoPath;
        }

        // Handle banner upload
        if ($this->banner) {
            if ($this->store->banner) {
                Storage::disk('public')->delete($this->store->banner);
            }
            $bannerPath = $this->banner->store('stores/banners', 'public');
            $data['banner'] = $bannerPath;
        }

        $this->store->update($data);

        // Reset file inputs
        $this->logo = null;
        $this->banner = null;

        session()->flash('message', 'Store settings updated successfully!');
    }

    public function outputFormValues()
    {
        $formValues = [
            'Basic Information' => [
                'name' => $this->name,
                'legal_business_name' => $this->legal_business_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'description' => $this->description,
            ],
            'Contact Information' => [
                'contact_person' => $this->contact_person,
                'alt_contact_phone' => $this->alt_contact_phone,
            ],
            'Address Information' => [
                'country_id' => $this->country_id,
                'state_id' => $this->state_id,
                'city_id' => $this->city_id,
                'zip_code' => $this->zip_code,
                'address' => $this->address,
            ],
            'Social Media' => [
                'website' => $this->website,
                'facebook' => $this->facebook,
                'instagram' => $this->instagram,
                'twitter' => $this->twitter,
            ],
            'Business Information' => [
                'business_type' => $this->business_type,
                'tax_id' => $this->tax_id,
                'business_registration_number' => $this->business_registration_number,
                'year_established' => $this->year_established,
            ],
            'File Uploads' => [
                'logo' => $this->logo ? 'File selected: ' . $this->logo->getClientOriginalName() : 'No file selected',
                'banner' => $this->banner ? 'File selected: ' . $this->banner->getClientOriginalName() : 'No file selected',
            ],
            'Current Store Data' => [
                'photo' => $this->store->photo,
                'banner' => $this->store->banner,
            ],
        ];

        dd($formValues);
    }

    public function render()
    {
        return view('livewire.store.settings.basic')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
