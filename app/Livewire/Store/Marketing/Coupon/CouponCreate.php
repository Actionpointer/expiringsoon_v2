<?php

namespace App\Livewire\Store\Marketing\Coupon;

use Livewire\Component;

class CouponCreate extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.coupon.coupon-create')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
