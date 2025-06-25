<?php

namespace App\Livewire\Store\Marketing\Newsletter;

use Livewire\Component;

class NewsletterTemplateSelection extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.newsletter.newsletter-template-selection')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
} 