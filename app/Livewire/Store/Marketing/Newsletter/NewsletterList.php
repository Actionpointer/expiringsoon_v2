<?php

namespace App\Livewire\Store\Marketing\Newsletter;

use Livewire\Component;

class NewsletterList extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.newsletter.newsletter-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 