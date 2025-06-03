<?php

namespace App\Livewire\Guest\Blog;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class BlogArticle extends Component
{
    public function render()
    {
        return view('livewire.guest.blog.blog-article');
    }
}
