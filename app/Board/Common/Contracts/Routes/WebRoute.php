<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Routes;

interface WebRoute extends Route
{
    /**
     * @return array<string>
     */
    public function webMiddleware(): array;
}
