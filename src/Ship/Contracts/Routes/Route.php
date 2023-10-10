<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Routes;

interface Route
{
    public function getMethod(): string|array;

    public function getFinalPath(): string;

    public function getControllerClass(): string;

    public function getControllerMethodName(): ?string;

    public function getFinalMiddlewares(): ?array;
}
