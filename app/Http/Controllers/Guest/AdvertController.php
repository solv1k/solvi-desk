<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    /**
     * Страница конкретного объявления.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function view(Advert $advert)
    {
        // прибавляем просмотр, только если смотрит не сам автор объявления
        if (! auth() || $advert->user_id !== auth()->id()) {
            $last_viewed_advert_id = session('last_viewed_advert_id');

            // сохраняем ID объявления в сессии, чтобы убрать дубликаты просмотров
            if ($last_viewed_advert_id !== $advert->id) {
                session()->put('last_viewed_advert_id', $advert->id);
                $advert->getTodayStat()->incView();
            }
        }

        if (! $advert->active) {
            abort(404);
        }

        return view('guest.adverts.single', compact('advert'));
    }
}
