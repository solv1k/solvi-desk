<?php

declare(strict_types=1);

namespace Src\Ship\Classes\Base\Data;

use Illuminate\Contracts\Pagination\Paginator;

abstract class BaseEloquentRepository extends BaseRepository
{
    public function get(array $fields = ['*']): array
    {
        return $this->builder->get($fields)->toArray();
    }

    public function paginate(?int $page = null, int $perPage = 15): Paginator
    {
        return $this->builder->paginate(page: $page, perPage: $perPage);
    }
}
