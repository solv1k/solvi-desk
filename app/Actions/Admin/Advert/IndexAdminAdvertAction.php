<?php

declare(strict_types=1);

namespace App\Actions\Admin\Advert;

use App\Models\Advert;

final class IndexAdminAdvertAction
{
    /**
     * Возвращает данные главной страницы объявлений для администратора.
     *
     * @return array{advertsCount:int,activeAdvertsCount:int,newAdvertsCount:int}
     */
    public function run(): array
    {
        $advertsCount = Advert::count();
        $activeAdvertsCount = Advert::active()->count();
        $newAdvertsCount = Advert::waitModeration()->count();

        return compact(
            'advertsCount',
            'activeAdvertsCount',
            'newAdvertsCount',
        );
    }
}
