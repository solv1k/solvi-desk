<?php

declare(strict_types=1);

namespace App\Board\Common\Base\UI\API\Routes;

use App\Board\Common\Base\Routes\BaseRoute;
use App\Board\Config\MiddlewareConfig;
use App\Board\Common\Contracts\Routes\ApiRoute;

abstract class BaseApiRoute extends BaseRoute implements ApiRoute
{
    public function apiMiddleware(): array
    {
        return MiddlewareConfig::apiMiddleware();
    }
}
