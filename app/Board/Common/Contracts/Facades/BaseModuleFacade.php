<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Facades;

abstract class BaseModuleFacade implements ModuleFacade
{
    public function view(string $path, string $scope = ''): string
    {
        return $this->config()->moduleName() . '::' . ($scope ? $scope . '.' : '') . $path;
    }
}
