<?php

declare(strict_types=1);

namespace App\Actions\User\Advert;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UnlikeAdvertAction
{
    /**
     * Убирает лайк от указанного пользователя.
     *
     * @param Advert $advert
     * @param User $user
     * @return void
     */
    public function run(Advert $advert, User $user): void
    {
        DB::transaction(function() use ($advert, $user) {
            if ($advert->userLikes()->where('user_id', auth()->id())->delete()) {
                $advert->getStatTotal()->decLike();
            }
        });
    }
}
