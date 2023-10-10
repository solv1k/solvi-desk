<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Common\Query;

use Src\Ship\Contracts\Data\Repositories\PaginationResult;

interface QueryBuilder
{
    public function get(array $columns = ['*']): array;

    public function where(array $conditions, string $scope = 'and'): static;

    public function like(array $conditions, string $scope = 'and'): static;

    public function scopedWhere(array $conditions, string $scope = 'and'): static;

    public function paginate(?int $page = null, int $perPage = 15): PaginationResult;
}
