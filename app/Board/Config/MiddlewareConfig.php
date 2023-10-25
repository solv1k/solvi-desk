<?php

declare(strict_types=1);

namespace App\Board\Config;

final class MiddlewareConfig
{
    /**
     * @return array<string>
     */
    public static function webMiddleware(): array
    {
        return ['web', 'auth:sanctum'];
    }

    /**
     * @return array<string>
     */
    public static function apiMiddleware(): array
    {
        return ['api', 'auth:sanctum'];
    }
}
