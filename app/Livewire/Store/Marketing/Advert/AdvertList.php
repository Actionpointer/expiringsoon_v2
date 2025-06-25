<?php

namespace App\Livewire\Store\Marketing\Advert;

use Livewire\Component;

class AdvertList extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.advert.advert-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 