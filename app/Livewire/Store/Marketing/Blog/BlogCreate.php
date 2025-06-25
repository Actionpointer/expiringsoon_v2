<?php

namespace App\Livewire\Store\Marketing\Blog;

use Livewire\Component;

class BlogCreate extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.blog.blog-create')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
