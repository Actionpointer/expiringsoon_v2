<?php

namespace App\Livewire\Store\Marketing\Sales;

use Livewire\Component;

class SalesList extends Component
{
    
    public function render()
    {
        return view('livewire.store.marketing.sales.sales-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
