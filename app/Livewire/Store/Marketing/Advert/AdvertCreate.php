<?php

namespace App\Livewire\Store\Marketing\Advert;

use Livewire\Component;

class AdvertCreate extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.advert.advert-create')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 