<?php

declare(strict_types=1);

namespace App\Board\Common\Base\UI\Web\Routes;

use App\Board\Common\Base\Routes\BaseRoute;
use App\Board\Config\MiddlewareConfig;
use App\Board\Common\Contracts\Routes\WebRoute;

abstract class BaseWebRoute extends BaseRoute implements WebRoute
{
    public function webMiddleware(): array
    {
        return MiddlewareConfig::webMiddleware();
    }
}
