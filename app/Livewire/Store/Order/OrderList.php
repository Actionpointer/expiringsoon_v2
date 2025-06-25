<?php

namespace App\Livewire\Store\Order;

use Livewire\Component;

class OrderList extends Component
{
    public function render()
    {
        return view('livewire.store.order.order-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 