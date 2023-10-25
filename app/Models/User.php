<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PermissionsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * Пользователь системы.
 */
final class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => PermissionsEnum::class,
    ];

    /**
     * Объявления пользователя.
     *
     * @return HasMany<Advert>
     */
    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class);
    }

    /**
     * Активные объявления пользователя.
     *
     * @return HasMany<Advert>
     */
    public function activeAdverts(): HasMany
    {
        return $this->adverts()->active();
    }

    /**
     * Лайкнутые пользователем объявления.
     *
     * @return HasMany<AdvertUserLike>
     */
    public function likedAdverts(): HasMany
    {
        return $this->hasMany(AdvertUserLike::class, 'user_id');
    }

    /**
     * Телефоны пользователя.
     *
     * @return HasMany<UserPhone>
     */
    public function phones(): HasMany
    {
        return $this->hasMany(UserPhone::class);
    }

    /**
     * Верифицированные телефоны пользователя.
     *
     * @return HasMany<UserPhone>
     */
    public function verifiedPhones(): HasMany
    {
        return $this->phones()->verified(true);
    }

    /**
     * Неверифицированные телефоны пользователя.
     *
     * @return HasMany<UserPhone>
     */
    public function unverifiedPhones(): HasMany
    {
        return $this->phones()->verified(false);
    }

    /**
     * У пользователя есть права администратора?
     */
    public function isAdmin(): bool
    {
        return $this->permissions === PermissionsEnum::ADMIN;
    }

    /**
     * Аккаунт пользователя активирован?
     */
    public function isActivated(): bool
    {
        return $this->isAdmin() || $this->hasVerifiedEmail();
    }

    /**
     * Даёт права активированного пользователя.
     */
    public function giveActivatedPermissions(): User
    {
        $this->permissions = PermissionsEnum::ACTIVATED_USER;
        $this->save();

        return $this;
    }

    /**
     * Даёт пользователю права администратора.
     */
    public function giveAdminPermissions(): User
    {
        $this->permissions = PermissionsEnum::ADMIN;
        $this->save();

        return $this;
    }

    /**
     * Возвращает описание прав пользователя.
     */
    public function getPermissionLabelAttribute(): string
    {
        return $this->permissions->label();
    }

    /**
     * Пользователь может создавать объявления?
     */
    public function hasCreateAdvertPermissions(): bool
    {
        return in_array($this->permissions, PermissionsEnum::allowedCreateAdvert());
    }

    /**
     * Пользователь может лайкать объявления?
     */
    public function canLikeAdverts(): bool
    {
        return true;
    }

    /**
     * Пользователь не заблокирован?
     */
    public function notBlocked(): bool
    {
        return $this->permissions !== PermissionsEnum::SUSPENDED_USER;
    }

    /**
     * Возвращает true, если телефон принадлежит пользователю.
     */
    public function hasPhone(int $user_phone_id): bool
    {
        return $this->phones()->where('id', $user_phone_id)->exists();
    }
}
