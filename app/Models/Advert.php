<?php

namespace App\Models;

use App\Enums\AdvertStatusEnum;
use App\Models\Pivots\AdvertUserPhone;
use App\Traits\Models\HasModerateAttributes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Объявление.
 * 
 * @method static \Illuminate\Database\Eloquent\Builder waitModeration()
 * @method static \Illuminate\Database\Eloquent\Builder active()
 */
class Advert extends Model
{
    use HasFactory, HasModerateAttributes, SoftDeletes;

    const CACHE_STAT_TOTAL_PREFIX = 'advert_stat_total_';
    const CACHE_STAT_TOTAL_TTL = 10;

    protected $fillable = [
        'user_id',
        'advert_category_id',
        'title',
        'description',
        'price'
    ];

    protected $moderate = [
        'advert_category_id',
        'title',
        'description'
    ];

    protected $casts = [
        'status' => AdvertStatusEnum::class
    ];

    protected $with = ['statTotal'];

    /**
     * Автор объявления.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Категория объявления.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(AdvertCategory::class, 'advert_category_id');
    }

    /**
     * Статистика объявления.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stats()
    {
        return $this->hasMany(AdvertStat::class);
    }

    /**
     * Суммарная статистика объявления.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statTotal()
    {
        return $this->hasOne(AdvertStatTotal::class);
    }

    /**
     * Возвращает статистику объявления на конкретную дату.
     * 
     * @param string $date
     * @return ?AdvertStat
     */
    public function getStatByDate(string $date = 'now'): ?AdvertStat
    {
        return $this->stats()->whereDate('date', Carbon::parse($date))->first();
    }

    /**
     * Возвращает статистику объявления за сегодня.
     * 
     * @return AdvertStat
     */
    public function getTodayStat(): AdvertStat
    {
        return $this
            ->stats()
            ->today()
            ->firstOrCreate([
                'date' => now()->toDateString()
            ]);
    }

    /**
     * Возвращает суммарную статистику объявления.
     * 
     * @return AdvertStatTotal
     */
    public function getStatTotal(): AdvertStatTotal
    {
        $cacheKey = implode('_', [
            static::CACHE_STAT_TOTAL_PREFIX,
            $this->id
        ]);

        return Cache::get(
            key: $cacheKey,
            default: function () use ($cacheKey) {
                $statTotal = $this->statTotal()->firstOrCreate();
                if (app()->environment('production')) {
                    Cache::put($cacheKey, $statTotal, static::CACHE_STAT_TOTAL_TTL);
                }
                return $statTotal;
            }
        );
    }

    /**
     * Телефоны привязанные к объявлению.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userPhones()
    {
        return $this->belongsToMany(UserPhone::class)->using(AdvertUserPhone::class);
    }

    /**
     * Лайки пользователей.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userLikes()
    {
        return $this->hasMany(AdvertUserLike::class, 'advert_id');
    }

    /**
     * Текущий (выбранный пользователем) телефон, привязанный к объявлению.
     * 
     * @return ?UserPhone
     */
    public function selectedUserPhone(): ?UserPhone
    {
        return $this
            ->userPhones()
            ->withPivot(['contact_name'])
            ->where('selected', 1)
            ->first();
    }

    /**
     * Привязывает телефон пользователя к объявлению.
     * 
     * @param int $userPhoneId
     * @param string $contactName
     * @return Advert
     */
    public function setSelectedUserPhone(int $userPhoneId, string $contactName): Advert
    {
        // добавляем связь телефона с объявлением в пивот
        $this->userPhones()->syncWithoutDetaching([$userPhoneId]);

        // открепляем предыдущий телефон от объявления
        $this->userPhones()->update([
            'selected' => 0
        ]);

        // прикрепляем новый телефон
        $this->userPhones()->updateExistingPivot($userPhoneId, [
            'selected' => 1,
            'contact_name' => $contactName
        ]);

        // если это новое объявление (объявление не активно)
        if (! $this->active) {
            // отправляем на модерацию
            $this->sendToModeration();
        }

        return $this;
    }

    /**
     * Возвращает true, если объявление активно.
     */
    public function getActiveAttribute(): bool
    {
        return $this->status === AdvertStatusEnum::ACTIVE;
    }

    /**
     * Возвращает имя для контактов объявления.
     * 
     * @return string
     */
    public function getContactNameAttribute(): string
    {
        return $this->selected_contact_name ?? $this->owner->name;
    }

    /**
     * Возвращает контактный номер телефона.
     * 
     * @return string
     */
    public function getPhoneNumberAttribute(): ?string
    {
        return $this->selected_phone_number;
    }

    /**
     * Все изображения, прикрепленные к объявлению.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(AdvertImage::class);
    }

    /**
     * Возвращает URL к главному изображению объявления.
     * 
     * @return string
     */
    public function getMainImageUrlAttribute(): string
    {
        if ($this->main_image_path) {
            return url(str_replace('public', 'storage', $this->main_image_path));
        } else {
            return advert_image_placeholder();
        }
    }

    /**
     * Устанавливает главное изображения объявления.
     * 
     * @return Advert
     */
    public function setMainImage(string $image_path): Advert
    {
        $this->main_image_path = $image_path;
        $this->save();

        return $this;
    }

    /**
     * Возвращает true, если у объявления есть главное изображение.
     * 
     * @return bool
     */
    public function hasMainImage(): bool
    {
        return !empty($this->main_image_path);
    }

    /**
     * Устанавливает объявлению статус "Необходимо указать телефон".
     * 
     * @return Advert
     */
    public function setWaitPhoneStatus(): Advert
    {
        $this->status = AdvertStatusEnum::WAIT_PHONE;
        $this->save();

        return $this;
    }

    /**
     * Устанавливает объявлению статус "Активно".
     * 
     * @return Advert
     */
    public function setActiveStatus(): Advert
    {
        $this->status = AdvertStatusEnum::ACTIVE;
        $this->save();

        return $this;
    }

    /**
     * Устанавливает объявлению статус "На модерации".
     * 
     * @return Advert
     */
    public function setModerateStatus(): Advert
    {
        $this->status = AdvertStatusEnum::WAIT_MODERATION;
        $this->save();

        return $this;
    }

    /**
     * Отправляет объявление на модерацию.
     * 
     * @return Advert
     */    
    public function sendToModeration(): Advert
    {
        return $this->setModerateStatus();
    }

    /**
     * Все объявления, ожидающие модерации.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWaitModeration($query)
    {
        return $query->where('status', AdvertStatusEnum::WAIT_MODERATION);
    }

    /**
     * Возвращает true, если объявление требует модерации.
     * 
     * @return bool
     */
    public function isWaitModeration(): bool
    {
        return $this->status === AdvertStatusEnum::WAIT_MODERATION;
    }

    /**
     * Возвращает текстовый лейбл статуса объявления.
     * 
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status->label();
    }

    /**
     * Все активные объявления.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', AdvertStatusEnum::ACTIVE);
    }

    /**
     * Было ли объявление лайкнуто пользователем.
     *
     * @param integer|User $user ID или модель пользователя
     * @return boolean
     */
    public function isLikedByUser(int|User $user): bool
    {
        $userId = is_int($user) ? $user : $user->id;

        return $this->userLikes()
            ->where('user_id', $userId)
            ->exists();
    }

    public function scopeJoinUserLike(Builder $query)
    {
        if (auth()->id()) {
            return $query
                ->addSelect([
                    DB::raw('EXISTS(SELECT id FROM advert_user_likes WHERE advert_id = adverts.id AND user_id='.auth()->id().') as has_user_like')
                ]);
        }
        return $query;
    }

    public function scopeJoinSelectedUserPhone(Builder $query)
    {
        return $query
            ->join('advert_user_phone', 'advert_user_phone.advert_id', 'adverts.id')
            ->join('user_phones', 'advert_user_phone.user_phone_id', 'user_phones.id')
            ->where('advert_user_phone.selected', true)
            ->addSelect([
                DB::raw('user_phones.number as selected_phone_number'),
                DB::raw('advert_user_phone.contact_name as selected_contact_name'),
            ]);
    }
}
