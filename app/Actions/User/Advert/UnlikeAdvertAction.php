<?php

declare(strict_types=1);

namespace App\Actions\User\Advert;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class UnlikeAdvertAction
{
    /**
     * Убирает лайк от указанного пользователя.
     */
    public function run(Advert $advert, User $user): void
    {
        DB::transaction(static function () use ($advert, $user): void {
            if ($advert->userLikes()->where('user_id', $user->id)->delete()) {
                $advert->getStatTotal()->decLike();
            }
        });
    }
}
