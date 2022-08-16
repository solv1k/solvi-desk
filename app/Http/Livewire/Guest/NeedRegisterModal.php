<?php

namespace App\Http\Livewire\Guest;

use Livewire\Component;

class NeedRegisterModal extends Component
{
    public $show = false;

    public function render()
    {
        return view('livewire.guest.need-register-modal');
    }
}
