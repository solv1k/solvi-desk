<?php

declare(strict_types=1);

namespace App\Actions\User\Advert;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class LikeAdvertAction
{
    /**
     * Добавляет лайк объявлению от указанного пользователя.
     */
    public function run(Advert $advert, User $user): void
    {
        DB::transaction(static function () use ($advert, $user): void {
            // добавляем лайк от юзера
            $advert->userLikes()->updateOrCreate([
                'user_id' => $user->id,
            ]);
            // добавляем лайк в статку
            $advert->getStatTotal()->incLike();
        });
    }
}
