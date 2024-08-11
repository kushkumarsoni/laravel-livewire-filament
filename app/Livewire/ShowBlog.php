<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Blog')]
class ShowBlog extends Component
{
    public $blog;

    public function mount($slug)
    {
        $this->blog = Blog::with('category')->where('slug',$slug)->published()->first();
    }

    public function render()
    {
        return view('livewire.show-blog');
    }
}
