<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\UI\API\Routes;

use Src\Containers\User\Advert\UI\API\Controllers\CreateAdvertController;
use Src\Ship\Classes\Base\Routes\BaseApiRoute;

class CreateAdvertRoute extends BaseApiRoute
{
    public function getMethod(): string|array
    {
        return 'POST';
    }

    public function getPath(): string
    {
        return '/users/adverts';
    }

    public function getControllerClass(): string
    {
        return CreateAdvertController::class;
    }
}
