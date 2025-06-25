<?php

namespace App\Livewire\Store\Order;

use Livewire\Component;

class DisputeList extends Component
{
    public function render()
    {
        return view('livewire.store.order.dispute-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 