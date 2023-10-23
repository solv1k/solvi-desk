<?php

declare(strict_types=1);

namespace App\Actions\Guest\Advert;

use App\Models\Advert;

final class ViewGuestAdvertAction
{
    /**
     * Просмотр карточки объявления в режиме "гостя".
     */
    public function run(Advert $advert): Advert
    {
        // прибавляем просмотр, только если смотрит не сам автор объявления
        if ($advert->user_id !== auth()->id()) {
            $last_viewed_advert_id = session('last_viewed_advert_id');

            // сохраняем ID объявления в сессии, чтобы убрать дубликаты просмотров
            if ($last_viewed_advert_id !== $advert->id) {
                session()->put('last_viewed_advert_id', $advert->id);
                $advert->getTodayStat()->incView();
            }
        }

        return $advert;
    }
}
