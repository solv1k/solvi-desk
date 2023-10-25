<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Config;

interface ModuleConfig
{
    public function moduleName(): string;

    public function viewsFolder(): string;

    public function apiPrefix(): string;

    public function cachePrefix(): string;
}
