<?php

declare(strict_types=1);

namespace App\Http\Livewire\User\Adverts;

use App\Actions\User\Advert\LikeAdvertAction;
use App\Actions\User\Advert\UnlikeAdvertAction;
use App\Models\Advert;
use Livewire\Component;

final class LikeButton extends Component
{
    /** @var \App\Models\User */
    public $user;

    /** @var \App\Models\Advert */
    public $advert;

    /** @var int */
    public $likesCount;

    /** @var int */
    public $viewsCount;

    /** @var bool */
    public $wasLiked = false;

    public function mount(Advert $advert): void
    {
        $statTotal = $this->advert->getStatTotal();

        $this->advert = $advert;
        $this->user = auth()->user();
        $this->wasLiked = $advert->has_user_like;
        $this->likesCount = $statTotal?->likes ?? 0;
        $this->viewsCount = $statTotal?->views ?? 0;
    }

    /**
     * Ставит или убирает лайк с объявления.
     */
    public function toggle()
    {
        if (! $this->user->canLikeAdverts()) {
            return false;
        }

        if (! $this->wasLiked) {
            app_make(LikeAdvertAction::class)->run(
                advert: $this->advert,
                user: $this->user
            );
            $this->likesCount++;
        } else {
            app_make(UnlikeAdvertAction::class)->run(
                advert: $this->advert,
                user: $this->user
            );
            $this->likesCount--;
        }

        $this->wasLiked = ! $this->wasLiked;
    }

    public function render()
    {
        return view('livewire.user.adverts.like-button');
    }
}
