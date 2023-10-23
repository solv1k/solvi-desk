<?php

declare(strict_types=1);

namespace App\Actions\Admin\Dashboard;

use App\Models\Advert;
use App\Models\AdvertCategory;

final class IndexAdminDashboardAction
{
    /**
     * Возвращает данные для дашборда администратора.
     *
     * @return array{advertsCount:int,newAdvertsCount:int,categoriesCount:int}
     */
    public function run(): array
    {
        $advertsCount = Advert::count();
        $newAdvertsCount = Advert::waitModeration()->count();
        $categoriesCount = AdvertCategory::count();

        return compact(
            'advertsCount',
            'newAdvertsCount',
            'categoriesCount',
        );
    }
}
