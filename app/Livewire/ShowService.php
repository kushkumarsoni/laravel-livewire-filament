<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ShowService extends Component
{
    public $service;
    public function mount($id)
    {
        $this->service = Service::published()->where('id',$id)->first();
    }

    public function render()
    {
        return view('livewire.show-service')->title($this->service?->title);
    }
}
