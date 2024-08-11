<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\HomeSetting;

class ShowHome extends Component
{
    public $services;
    public $homeSetting;

    public function render()
    {
        $this->services = Service::published()->latest()->get();
        $this->homeSetting = HomeSetting::orderBy('id','desc')->first();
        return view('livewire.show-home')->title('Home');
    }
}
