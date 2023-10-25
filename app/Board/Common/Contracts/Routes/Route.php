<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Routes;

interface Route
{
    /**
     * @return string|array<string>
     */
    public function method(): string|array;

    public function uri(): string;

    /**
     * @return class-string
     */
    public function controllerClass(): string;

    public function controllerMethod(): ?string;

    /**
     * @return string|array<string>|null
     */
    public function middleware(): string|array|null;
}
