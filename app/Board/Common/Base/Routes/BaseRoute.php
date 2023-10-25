<?php

declare(strict_types=1);

namespace App\Board\Common\Base\Routes;

use App\Board\Common\Contracts\Routes\Route;

abstract class BaseRoute implements Route
{
    public function controllerMethod(): ?string
    {
        return null;
    }

    public function middleware(): string|array|null
    {
        return null;
    }
}
