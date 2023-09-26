<?php

declare(strict_types=1);

namespace App\Actions\Admin\Dashboard;

use App\Models\Advert;
use App\Models\AdvertCategory;

class IndexAdminDashboardAction
{
    /**
     * Возвращает данные для дашборда администратора.
     *
     * @return array
     */
    public function run(): array 
    {
        $adverts_count = Advert::count();
        $new_adverts_count = Advert::waitModeration()->count();
        $categories_count = AdvertCategory::count();

        return compact(
            'adverts_count',
            'new_adverts_count',
            'categories_count',
        );
    }
}
