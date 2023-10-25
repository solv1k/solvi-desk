<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Routes;

interface ApiRoute extends Route
{
    /**
     * @return array<string>
     */
    public function apiMiddleware(): array;
}
