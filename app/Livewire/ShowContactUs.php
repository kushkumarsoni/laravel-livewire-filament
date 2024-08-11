<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactUs;
use App\Models\SiteSetting;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;

#[Title('Contact Us')]
class ShowContactUs extends Component
{
    public $setting;

    #[Rule('required')]
    public $name = '';

    #[Rule('required|email')]
    public $email = '';

    #[Rule('required|numeric|digits:10')]
    public $mobile = '';

    #[Rule('nullable')]
    public $message = '';

    #[Rule('nullable')]
    public $subject = '';

    public function saveContact()
    {
        $this->validate();

        ContactUs::create(
            $this->only(['name', 'email','mobile','message','subject'])
        );

        session()->flash('message', 'Your query submitted successfully');
        return $this->redirect('/contact');

    }

    public function render()
    {
        $this->setting = SiteSetting::orderBy('id','desc')->first();
        return view('livewire.show-contact-us');
    }


}
