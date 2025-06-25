<?php

namespace App\Livewire\Store\Marketing\Blog;

use Livewire\Component;

class BlogArticle extends Component
{
    public function render()
    {
        return view('livewire.store.marketing.blog.blog-article')
        ->extends('layouts.frontend.store.app')
        ->section('content');
    }
}
