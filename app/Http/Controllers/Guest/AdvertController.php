<?php

namespace App\Http\Controllers\Guest;

use App\Actions\Guest\Advert\ViewGuestAdvertAction;
use App\Http\Controllers\Controller;
use App\Models\Advert;
use Illuminate\Contracts\View\View;

class AdvertController extends Controller
{
    /**
     * Просмотр карточки объявления в режиме "гостя".
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function view(
        int $advertId,
        ViewGuestAdvertAction $action
    ): View {
        $advert = Advert::query()
            ->where('adverts.id', $advertId)
            ->select('adverts.*')
            ->joinUserLike()
            ->joinSelectedUserPhone()
            ->first();

        if (! $advert->active) {
            abort(404);
        }

        return view('guest.adverts.single', [
            'advert' => $action->run($advert)
        ]);
    }
}
