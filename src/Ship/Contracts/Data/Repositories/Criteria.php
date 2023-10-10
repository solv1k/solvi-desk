<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Data\Repositories;

use Src\Ship\Contracts\Common\Query\QueryBuilder;

interface Criteria
{
    public function setScope(string $scope = 'and'): static;

    public function getScope(): string;

    public function apply(QueryBuilder $builder): QueryBuilder;
}
