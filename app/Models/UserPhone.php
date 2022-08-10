<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Телефон пользователя.
 * 
 * @method static \Illuminate\Database\Eloquent\Builder verified(bool $verified = true)
 */
class UserPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number'
    ];

    /**
     * Смена статуса верификации телефона.
     * 
     * @return UserPhone
     */
    public function setVerified(bool $verified = true): UserPhone
    {
        $this->verified = (int)$verified;
        $this->save();

        return $this;
    }

    /**
     * Возвращает текстовый лейбл верификации.
     * 
     * @return string
     */
    public function verifiedLabel(): string
    {
        return match($this->verified) {
            1 => __('Verified'),
            default => __('Not verified')
        };
    }

    /**
     * Все верифицированные телефоны.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified($query, bool $verified = true)
    {
        return $query->where('verified', (int)$verified);
    }
}
