<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Blogs')]
class ShowBlogs extends Component
{
    public function render()
    {
        $blogs = Blog::published()->latest()->paginate(12);
        $categories = Category::with('blogs')->latest()->get();
        return view('livewire.show-blogs',compact('categories','blogs'));
    }
}
