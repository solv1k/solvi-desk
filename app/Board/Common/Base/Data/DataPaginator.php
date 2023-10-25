<?php

declare(strict_types=1);

namespace App\Board\Common\Base\Data;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\PaginatedDataCollection;

final class DataPaginator
{
    /**
     * @param  LengthAwarePaginator<mixed>  $paginator
     */
    public function __construct(
        protected LengthAwarePaginator $paginator,
        protected string $dtoClass
    ) {
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        /** @var PaginatedDataCollection<int, mixed> */
        $paginatedDataCollection = $this->dtoClass::collection($this->paginator);

        return $paginatedDataCollection->items()->items();
    }
}
