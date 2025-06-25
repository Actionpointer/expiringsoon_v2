<?php

namespace App\Livewire\Store\Marketing\Advert;

use Livewire\Component;

class AdvertShow extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.advert.advert-show')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 