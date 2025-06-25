<?php

namespace App\Livewire\Store\Marketing\Newsletter;

use Livewire\Component;

class NewsletterPreview extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.newsletter.newsletter-preview')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 