<?php

namespace App\Livewire\Store\Marketing\Newsletter;

use Livewire\Component;

class NewsletterEdit extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.newsletter.newsletter-edit')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 