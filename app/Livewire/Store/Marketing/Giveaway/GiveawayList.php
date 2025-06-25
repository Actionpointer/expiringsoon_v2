<?php

namespace App\Livewire\Store\Marketing\Giveaway;

use Livewire\Component;

class GiveawayList extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.giveaway.giveaway-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
