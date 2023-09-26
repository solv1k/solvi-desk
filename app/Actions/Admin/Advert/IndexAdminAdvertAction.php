<?php

declare(strict_types=1);

namespace App\Actions\Admin\Advert;

use App\Models\Advert;

class IndexAdminAdvertAction
{
    /**
     * Возвращает данные главной страницы объявлений для администратора.
     *
     * @return array
     */
    public function run(): array 
    {
        $adverts_count = Advert::count();
        $active_adverts_count = Advert::active()->count();
        $new_adverts_count = Advert::waitModeration()->count();

        return compact(
            'adverts_count',
            'active_adverts_count',
            'new_adverts_count',
        );
    }
}
