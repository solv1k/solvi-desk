<?php

declare(strict_types=1);

namespace App\Board\Common\Base\Data\DTO;

use App\Board\Common\Base\Data\DataPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\Data;

abstract class BaseDTO extends Data
{
    /**
     * @param  LengthAwarePaginator<mixed>  $paginator
     */
    public static function paginate(LengthAwarePaginator $paginator): DataPaginator
    {
        return new DataPaginator($paginator, static::class);
    }
}
