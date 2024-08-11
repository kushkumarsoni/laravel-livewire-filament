<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class ShowPage extends Component
{
    public $page;
    public function mount($slug)
    {
        $this->page = Page::where('slug',$slug)->published()->firstOrFail();
    }

    public function render()
    {
        return view('livewire.show-page')->title($this->page?->title);
    }
}
