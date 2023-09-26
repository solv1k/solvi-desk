<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Статистика объявления.
 * 
 * @method static \Illuminate\Database\Eloquent\Builder today()
 */
class AdvertStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'views',
        'phone_views'
    ];

    /**
     * Значения по умолчанию.
     * 
     * @var array
     */
    protected $attributes = [
        'views' => 0,
        'phone_views' => 0
    ];

    /**
     * Статистика объявления за сегодня.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday($query)
    {
        return $query->whereDate('date', Carbon::now());
    }

    /**
     * Суммарная статистика по объявлению.
     */
    public function totals()
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
    public function incView()
    {
        DB::transaction(function () {
            $this->views += 1;
            $this->save();
            // inc totals
            $this->getTotals()->incView();
        });
    }

    /**
     * +1 лайк в статистику.
     */
    public function incLike()
    {
        $this->getTotals()->incLike();
    }

    /**
     * -1 лайк в статистику.
     */
    public function decLike()
    {
        $this->getTotals()->decLike();
    }
}
