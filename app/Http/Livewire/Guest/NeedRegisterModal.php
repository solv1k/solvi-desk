<?php

declare(strict_types=1);

namespace App\Http\Livewire\Guest;

use Livewire\Component;

final class NeedRegisterModal extends Component
{
    public $show = false;

    public function render()
    {
        return view('livewire.guest.need-register-modal');
    }
}
