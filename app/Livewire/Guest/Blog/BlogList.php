<?php

namespace App\Livewire\Guest\Blog;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.frontend.customer.app')]
class BlogList extends Component
{
    public function render()
    {
        return view('livewire.guest.blog.blog-list');
    }
}
