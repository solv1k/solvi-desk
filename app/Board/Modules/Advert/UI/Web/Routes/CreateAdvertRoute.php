<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\UI\Web\Routes;

use App\Board\Common\Base\UI\Web\Routes\BaseWebRoute;
use App\Board\Modules\Advert\UI\Web\Controllers\CreateAdvertController;

final class CreateAdvertRoute extends BaseWebRoute
{
    /**
     * @return string|array<string>
     */
    public function method(): string|array
    {
        return 'POST';
    }

    public function uri(): string
    {
        return '/adverts/create';
    }

    public function controllerClass(): string
    {
        return CreateAdvertController::class;
    }
}
