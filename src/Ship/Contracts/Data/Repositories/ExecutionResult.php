<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Data\Repositories;

interface ExecutionResult
{
    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array;
}
