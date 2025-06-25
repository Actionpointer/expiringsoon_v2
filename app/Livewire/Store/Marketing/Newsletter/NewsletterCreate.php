<?php

namespace App\Livewire\Store\Marketing\Newsletter;

use Livewire\Component;

class NewsletterCreate extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.newsletter.newsletter-create')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 