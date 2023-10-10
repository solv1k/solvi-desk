<?php

declare(strict_types=1);

namespace Src\Framework\Decorators\Common\Query;

use Illuminate\Database\Eloquent\Builder;
use Src\Ship\Classes\Data\Criterias\WhereCriteria;
use Src\Ship\Contracts\Common\Query\QueryBuilder;
use Src\Ship\Contracts\Data\Repositories\PaginationResult;

class EloquentQueryBuilderDecorator implements QueryBuilder
{
    public function __construct(
        private Builder $builder
    ) {}

    public function get(array $columns = ['*']): array
    {
        return $this->builder->get($columns)->toArray();
    }

    public function where(array $conditions, string $scope = 'and'): static
    {
        $this->builder = $this->builder->where(column: $conditions, boolean: $scope);
        return $this;
    }

    public function like(array $conditions, string $scope = 'and'): static
    {
        foreach ($conditions as $key => $value) {
            $this->builder = $this->builder->where($key, 'LIKE', $value, $scope);
        }
        return $this;
    }

    public function scopedWhere(array $conditions, string $scope = 'and'): static
    {
        $this->builder = $this->builder->where(function () use ($conditions, $scope) {
            foreach ($conditions as $condition) {
                if (! $condition instanceof WhereCriteria) {
                    throw new \Exception('Only WhereCriteria can be loaded in scope.');
                }
                $condition->setScope($scope);
                $condition->apply($this);
            }
        });
        return $this;
    }

    public function paginate(?int $page = null, int $perPage = 15): PaginationResult
    {
        return $this->builder->paginate($perPage, $page);
    }
}
