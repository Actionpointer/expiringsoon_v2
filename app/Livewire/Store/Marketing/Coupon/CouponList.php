<?php

namespace App\Livewire\Store\Marketing\Coupon;

use Livewire\Component;

class CouponList extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.coupon.coupon-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
