<?php

namespace App\Http\Livewire\Guest\Adverts;

use App\Models\Advert;
use Livewire\Component;

class LikeButton extends Component
{
    /** @var \App\Models\Advert */
    public $advert;

    /** @var \App\Models\AdvertStatTotal */
    public $stat_total;

    public function mount(Advert $advert)
    {
        $this->advert = $advert;
        $this->stat_total = $this->advert->getStatTotal();
    }

    public function render()
    {
        return view('livewire.guest.adverts.like-button');
    }
}
