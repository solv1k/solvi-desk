<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

/**
 * Статистика объявления.
 */
final class AdvertStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'views',
        'phone_views',
    ];

    /**
     * Значения по умолчанию.
     *
     * @var array<string,mixed>
     */
    protected $attributes = [
        'views' => 0,
        'phone_views' => 0,
    ];

    /**
     * Статистика объявления за сегодня.
     *
     * @param Builder<self> $query
     * @return Builder<self>
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('date', Carbon::now()->toDateString());
    }

    /**
     * Суммарная статистика объявления.
     * 
     * @return HasOne<AdvertStatTotal>
     */
    public function totals(): HasOne
    {
        return $this->hasOne(AdvertStatTotal::class, 'advert_id', 'advert_id');
    }

    /**
     * Возвращает связанную суммарную статистику по объявлению.
     */
    public function getTotals(): AdvertStatTotal
    {
        $totals = $this->totals;

        if (! $totals) {
            $totals = $this->totals()->create();
        }

        return $totals;
    }

    /**
     * +1 просмотр в статистику.
     */
    public function incView(): void
    {
        DB::transaction(function (): void {
            $this->views += 1;
            $this->save();
            // inc totals
            $this->getTotals()->incView();
        });
    }

    /**
     * +1 лайк в статистику.
     */
    public function incLike(): void
    {
        $this->getTotals()->incLike();
    }

    /**
     * -1 лайк в статистику.
     */
    public function decLike(): void
    {
        $this->getTotals()->decLike();
    }
}
