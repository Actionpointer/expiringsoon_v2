<?php

namespace App\Livewire\Store\Order;

use Livewire\Component;

class OrderShow extends Component
{
    public function render()
    {
        return view('livewire.store.order.order-show')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 