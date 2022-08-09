<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Статистика объявления.
 */
class AdvertStat extends Model
{
    use HasFactory;

    /**
     * Статистика объявления за сегодня.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopeToday($query)
    {
        return $query->whereDate('date', Carbon::now());
    }
}
