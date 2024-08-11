<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Faqs')]
class ShowFaq extends Component
{
    public function render()
    {
        $faqs = Faq::published()->latest()->get();
        return view('livewire.show-faq',compact('faqs'));
    }
}
