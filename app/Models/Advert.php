<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AdvertStatusEnum;
use App\Models\Pivots\AdvertUserPhone;
use App\Traits\Models\HasModerateAttributes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Объявление.
 */
final class Advert extends Model
{
    use HasFactory;
    use HasModerateAttributes;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'advert_category_id',
        'title',
        'description',
        'price',
    ];

    /** @var array<string> */
    protected $moderate = [
        'advert_category_id',
        'title',
        'description',
    ];

    /** @var array<string,string> */
    protected $casts = [
        'status' => AdvertStatusEnum::class,
    ];

    /** @var array<string,mixed> */
    protected $attributes = [
        'status' => AdvertStatusEnum::CREATED,
    ];

    /** @var array<string> */
    protected $with = ['statTotal'];

    /**
     * Автор объявления.
     * 
     * @return BelongsTo<User,self>
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Категория объявления.
     * 
     * @return BelongsTo<AdvertCategory,self>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(AdvertCategory::class, 'advert_category_id');
    }

    /**
     * Статистика объявления.
     * 
     * @return HasMany<AdvertStat>
     */
    public function stats(): HasMany
    {
        return $this->hasMany(AdvertStat::class);
    }

    /**
     * Суммарная статистика объявления.
     * 
     * @return HasOne<AdvertStatTotal>
     */
    public function statTotal(): HasOne
    {
        return $this->hasOne(AdvertStatTotal::class);
    }

    /**
     * Возвращает статистику объявления на конкретную дату.
     *
     * @return ?AdvertStat
     */
    public function getStatByDate(string $date = 'now'): ?AdvertStat
    {
        return $this->stats()->whereDate('date', Carbon::parse($date)->toDateString())->first();
    }

    /**
     * Возвращает статистику объявления за сегодня.
     */
    public function getTodayStat(): AdvertStat
    {
        return $this
            ->stats()
            ->today()
            ->firstOrCreate([
                'date' => now()->toDateString(),
            ]);
    }

    /**
     * Возвращает суммарную статистику объявления.
     */
    public function getStatTotal(): AdvertStatTotal
    {
        $cacheKey = config('board.adverts.cache_prefix') . $this->id;

        return Cache::get(
            key: $cacheKey,
            default: function () use ($cacheKey) {
                $statTotal = $this->statTotal()->firstOrCreate();
                if (app()->environment('production')) {
                    Cache::put($cacheKey, $statTotal, config('board.adverts.cache_ttl'));
                }

                return $statTotal;
            }
        );
    }

    /**
     * Телефоны привязанные к объявлению.
     *
     * @return BelongsToMany<UserPhone>
     */
    public function userPhones(): BelongsToMany
    {
        return $this->belongsToMany(UserPhone::class)->using(AdvertUserPhone::class);
    }

    /**
     * Лайки пользователей.
     *
     * @return HasMany<AdvertUserLike>
     */
    public function userLikes(): HasMany
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
     */
    public function setSelectedUserPhone(int $userPhoneId, string $contactName): Advert
    {
        // добавляем связь телефона с объявлением в пивот
        $this->userPhones()->syncWithoutDetaching([$userPhoneId]);

        // открепляем предыдущий телефон от объявления
        $this->userPhones()->update([
            'selected' => 0,
        ]);

        // прикрепляем новый телефон
        $this->userPhones()->updateExistingPivot($userPhoneId, [
            'selected' => 1,
            'contact_name' => $contactName,
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
     */
    public function getContactNameAttribute(): string
    {
        return $this->selected_contact_name ?? $this->owner->name;
    }

    /**
     * Возвращает контактный номер телефона.
     */
    public function getPhoneNumberAttribute(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->selected_phone_number;
    }

    /**
     * Все изображения, прикрепленные к объявлению.
     *
     * @return HasMany<AdvertImage>
     */
    public function images(): HasMany
    {
        return $this->hasMany(AdvertImage::class);
    }

    /**
     * Возвращает URL к главному изображению объявления.
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
     */
    public function setMainImage(string $imagePath): Advert
    {
        $this->main_image_path = $imagePath;
        $this->save();

        return $this;
    }

    /**
     * Возвращает true, если у объявления есть главное изображение.
     */
    public function hasMainImage(): bool
    {
        return ! empty($this->main_image_path);
    }

    /**
     * Устанавливает объявлению статус "Необходимо указать телефон".
     */
    public function setWaitPhoneStatus(): Advert
    {
        $this->status = AdvertStatusEnum::WAIT_PHONE;
        $this->save();

        return $this;
    }

    /**
     * Устанавливает объявлению статус "Активно".
     */
    public function setActiveStatus(): Advert
    {
        $this->status = AdvertStatusEnum::ACTIVE;
        $this->save();

        return $this;
    }

    /**
     * Устанавливает объявлению статус "На модерации".
     */
    public function setModerateStatus(): Advert
    {
        $this->status = AdvertStatusEnum::WAIT_MODERATION;
        $this->save();

        return $this;
    }

    /**
     * Отправляет объявление на модерацию.
     */
    public function sendToModeration(): Advert
    {
        return $this->setModerateStatus();
    }

    /**
     * Все объявления, ожидающие модерации.
     *
     * @param Builder<self> $query
     * @return Builder<self>
     */
    public function scopeWaitModeration(Builder $query): Builder
    {
        return $query->where('status', AdvertStatusEnum::WAIT_MODERATION);
    }

    /**
     * Возвращает true, если объявление требует модерации.
     */
    public function isWaitModeration(): bool
    {
        return $this->status === AdvertStatusEnum::WAIT_MODERATION;
    }

    /**
     * Возвращает текстовый лейбл статуса объявления.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status->label();
    }

    /**
     * Все активные объявления.
     * 
     * @param Builder<self> $query
     * @return Builder<self>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', AdvertStatusEnum::ACTIVE);
    }

    /**
     * Было ли объявление лайкнуто пользователем?
     */
    public function isLikedByUser(int|User $user): bool
    {
        $userId = is_int($user) ? $user : $user->id;

        return $this->userLikes()
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Джойнит лайк от текущего юзера.
     * 
     * @param Builder<self> $query
     * @return Builder<self>
     */
    public function scopeJoinUserLike(Builder $query): Builder
    {
        if (auth()->id()) {
            return $query
                ->addSelect([
                    DB::raw('EXISTS(SELECT id FROM advert_user_likes WHERE advert_id = adverts.id AND user_id=' . auth()->id() . ') as has_user_like'),
                ]);
        }

        return $query;
    }

    /**
     * Джойнит выбранный юзером телефон.
     * 
     * @param Builder<self> $query
     * @return Builder<self>
     */
    public function scopeJoinSelectedUserPhone(Builder $query): Builder
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
