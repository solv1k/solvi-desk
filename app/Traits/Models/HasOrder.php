<?php

declare(strict_types=1);

namespace App\Traits\Models;

/**
 * @method \Illuminate\Database\Eloquent\Builder ordered(string $direction = "ASC")
 */
trait HasOrder
{
    /**
     * Записи модели отсортированные по полю "order".
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query, $direction = "ASC") 
    {
        return $query->orderBy('order', $direction);
    }
}
