<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Facades;

use App\Board\Common\Contracts\Config\ModuleConfig;

interface ModuleFacade
{
    public function config(): ModuleConfig;

    public function view(string $path, string $scope = ''): string;
}
