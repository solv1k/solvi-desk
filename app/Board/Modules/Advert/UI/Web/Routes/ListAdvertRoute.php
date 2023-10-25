<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\UI\Web\Routes;

use App\Board\Common\Base\UI\Web\Routes\BaseWebRoute;
use App\Board\Modules\Advert\UI\Web\Controllers\ListAdvertController;

final class ListAdvertRoute extends BaseWebRoute
{
    public function method(): string|array
    {
        return 'GET';
    }

    public function uri(): string
    {
        return '/adverts';
    }

    public function controllerClass(): string
    {
        return ListAdvertController::class;
    }
}
