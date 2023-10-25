<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Телефон пользователя.
 */
final class UserPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
    ];

    /**
     * Смена статуса верификации телефона.
     */
    public function setVerified(bool $verified = true): UserPhone
    {
        $this->verified = $verified;
        $this->save();

        return $this;
    }

    /**
     * Возвращает текстовый лейбл верификации.
     */
    public function verifiedLabel(): string
    {
        return $this->verified ? __('Verified') : __('Not verified');
    }

    /**
     * Все верифицированные телефоны пользователя.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeVerified(Builder $query, bool $verified = true): Builder
    {
        return $query->where('verified', $verified);
    }
}
