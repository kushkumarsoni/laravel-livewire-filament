<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class ShowMember extends Component
{
    public function render()
    {
        $members = Member::published()->latest()->get();
        return view('livewire.show-member',compact('members'))->title('Team Members');
    }
}
