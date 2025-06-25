<?php

namespace App\Livewire\Store\Marketing\Blog;

use Livewire\Component;

class BlogList extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.blog.blog-list')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
