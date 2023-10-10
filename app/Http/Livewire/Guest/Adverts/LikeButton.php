<?php

namespace App\Http\Livewire\Guest\Adverts;

use App\Models\Advert;
use Livewire\Component;

class LikeButton extends Component
{
    /** @var \App\Models\Advert */
    public $advert;

    /** @var int */
    public $likesCount;

    /** @var int */
    public $viewsCount;

    public function mount(Advert $advert)
    {
        $statTotal = $this->advert->getStatTotal();

        $this->advert = $advert;
        $this->likesCount = $statTotal?->likes ?? 0;
        $this->viewsCount = $statTotal?->views ?? 0;
    }

    public function render()
    {
        return view('livewire.guest.adverts.like-button');
    }
}
