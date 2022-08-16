<?php

namespace App\Http\Livewire\User\Adverts;

use App\Models\Advert;
use Livewire\Component;

class LikeButton extends Component
{
    public $advert;

    public $was_liked = false;

    public function mount(Advert $advert)
    {
        $this->advert = $advert;
        $this->was_liked = $advert->userLikes()->where('user_id', auth()->id())->exists();
    }

    /**
     * Ставит или убирает лайк с объявления.
     */
    public function toggle()
    {
        if ($this->was_liked) {
            $this->advert->userLikes()->where('user_id', auth()->id())->delete();
        } else {
            $this->advert->userLikes()->create([
                'user_id' => auth()->id()
            ]);
        }

        $this->was_liked = ! $this->was_liked;
    }

    public function render()
    {
        return view('livewire.user.adverts.like-button');
    }
}
