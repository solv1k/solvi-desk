<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Лайк объявления.
 */
final class AdvertUserLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * Пользователь лайкнувший объявление.
     *
     * @return BelongsTo<User,self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Лайкнутое объявление.
     *
     * @return BelongsTo<Advert,self>
     */
    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }
}
