<?php

namespace App\Http\Livewire\User\Adverts;

use App\Models\Advert;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LikeButton extends Component
{
    /** @var \App\Models\Advert */
    public $advert;

    /** @var \App\Models\AdvertStatTotal */
    public $stat_total;

    /** @var bool */
    public $was_liked = false;

    public function mount(Advert $advert)
    {
        $this->advert = $advert;
        $this->was_liked = $advert->userLikes()->where('user_id', auth()->id())->exists();
        $this->stat_total = $this->advert->getStatTotal();
    }

    /**
     * Ставит или убирает лайк с объявления.
     */
    public function toggle()
    {
        DB::transaction(function() {
            if ($this->was_liked) {
                $this->advert->userLikes()->where('user_id', auth()->id())->delete();
                $this->stat_total->decLike();
            } else {
                $this->advert->userLikes()->create([
                    'user_id' => auth()->id()
                ]);
                $this->stat_total->incLike();
            }
        });

        $this->was_liked = ! $this->was_liked;
    }

    public function render()
    {
        return view('livewire.user.adverts.like-button');
    }
}
