<?php

namespace App\Livewire;

use App\Models\Page;
use App\Models\Member;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('About Us')]
class ShowAboutUs extends Component
{
    public function render()
    {
        $page = Page::where('slug','about-us')->published()->firstOrFail();
        $members = Member::published()->latest()->get();
        return view('livewire.show-about-us',compact('page','members'));
    }
}
