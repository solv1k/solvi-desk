<?php

declare(strict_types=1);

namespace Src\Ship\Classes\Base\Routes;

use Src\Ship\Contracts\Routes\ApiRoute;

abstract class BaseApiRoute implements ApiRoute
{
    const BASE_API_MIDDLEWARE = ['auth:sanctum'];

    abstract public function getPath(): string;

    public function getMiddlewares(): array
    {
        return [];
    }

    public function getFinalPath(): string
    {
        return env('API_PREFIX') . $this->getPath();
    }

    public function getControllerMethodName(): ?string
    {
        return null;
    }

    public function getFinalMiddlewares(): ?array
    {
        return array_merge(static::BASE_API_MIDDLEWARE, $this->getMiddlewares());
    }
}
