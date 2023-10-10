<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Data\Repositories;

use Illuminate\Contracts\Pagination\Paginator;

interface ReadRepository
{
    public function get(array $fields = ['*']): array;

    public function paginate(?int $page = null, int $perPage = 15): Paginator;
}
