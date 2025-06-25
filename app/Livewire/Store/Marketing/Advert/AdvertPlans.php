<?php

namespace App\Livewire\Store\Marketing\Advert;

use Livewire\Component;

class AdvertPlans extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.advert.advert-plans')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 