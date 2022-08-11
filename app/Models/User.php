<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\PermissionsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Пользователь сервиса.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Объявления пользователя.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    /**
     * Телефоны пользователя.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phones()
    {
        return $this->hasMany(UserPhone::class);
    }

    /**
     * Верифицированные пользователя.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verifiedPhones()
    {
        return $this->phones()->verified(true);
    }

    /**
     * Неверифицированные телефоны пользователя.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unverifiedPhones()
    {
        return $this->phones()->verified(false);
    }

    /**
     * У пользователя есть права администратора?
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->permissions === PermissionsEnum::ADMIN->value;
    }

    /**
     * Аккаунт пользователя активирован?
     * 
     * @return bool
     */
    public function isActivated(): bool
    {
        return $this->isAdmin() || $this->hasVerifiedEmail();
    }

    /**
     * Даёт пользователю права администратора.
     * 
     * @return User
     */
    public function giveAdminPermissions(): User
    {
        $this->permissions = PermissionsEnum::ADMIN->value;
        $this->save();

        return $this;
    }

    /**
     * Возвращает описание прав пользователя.
     * 
     * @return string
     */
    public function getPermissionLabelAttribute(): string
    {
        return PermissionsEnum::from($this->permissions)->label();
    }

    /**
     * Пользователь может создавать объявления?
     * 
     * @return bool
     */
    public function hasCreateAdvertPermissions(): bool
    {
        return in_array($this->permissions, PermissionsEnum::allowedCreateAdvert());
    }

    /**
     * Пользователь не заблокирован?
     * 
     * @return bool
     */
    public function notBlocked(): bool
    {
        return $this->permissions !== PermissionsEnum::SUSPENDED_USER->value;
    }

    /**
     * Возвращает true, если телефон принадлежит пользователю.
     * 
     * @return bool
     */
    public function hasPhone(int $user_phone_id): bool
    {
        return $this->phones()->where('id', $user_phone_id)->exists();
    }
}
