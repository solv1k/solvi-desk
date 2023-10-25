<?php

declare(strict_types=1);

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method \Illuminate\Database\Eloquent\Builder ordered(string $direction = "ASC")
 */
trait HasOrder
{
    /**
     * Записи модели отсортированные по полю "order".
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeOrdered(Builder $query, string $direction = 'ASC'): Builder
    {
        return $query->orderBy('order', $direction);
    }
}
