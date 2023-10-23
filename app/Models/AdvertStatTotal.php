<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Суммарная статистика объявления.
 */
final class AdvertStatTotal extends Model
{
    use HasFactory;

    protected $fillable = [
        'views',
        'phone_views',
        'likes',
    ];

    /**
     * Значения по умолчанию.
     *
     * @var array<string,mixed>
     */
    protected $attributes = [
        'views' => 0,
        'phone_views' => 0,
        'likes' => 0,
    ];

    /**
     * +1 просмотр в общую статистику.
     */
    public function incView(): void
    {
        $this->views += 1;
        $this->save();
    }

    /**
     * +1 лайк в общую статистику.
     */
    public function incLike(): void
    {
        $this->likes += 1;
        $this->save();
    }

    /**
     * -1 лайк в общую статистику.
     */
    public function decLike(): void
    {
        $this->likes -= 1;
        $this->save();
    }
}
