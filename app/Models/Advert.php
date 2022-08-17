<?php

namespace App\Models;

use App\Enums\AdvertStatusEnum;
use App\Models\Pivots\AdvertUserPhone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Объявление.
 * 
 * @method static \Illuminate\Database\Eloquent\Builder waitModeration()
 * @method static \Illuminate\Database\Eloquent\Builder active()
 */
class Advert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'advert_category_id',
        'title',
        'description',
        'price'
    ];

    /** @var \App\Models\AdvertStatTotal */
    protected $cached_stat_total;

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
        $stat = $this->stats()->today()->first();

        if (! $stat) {
            $stat = $this->stats()->create([
                'date' => Carbon::now()
            ]);
        }

        return $stat;
    }

    /**
     * Возвращает суммарную статистику объявления.
     * 
     * @return AdvertStatTotal
     */
    public function getStatTotal(): AdvertStatTotal
    {
        if ($this->cached_stat_total) {
            return $this->cached_stat_total;
        }

        $stat_total = $this->statTotal;

        if (! $stat_total) {
            $stat_total = $this->statTotal()->create();
        }

        $this->cached_stat_total = $stat_total;

        return $stat_total;
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
        return $this->userPhones()->withPivot(['contact_name'])->where('selected', 1)->first();
    }

    /**
     * Привязывает телефон пользователя к объявлению.
     * 
     * @param int $user_phone_id
     * @param string $contact_name
     * @return Advert
     */
    public function setSelectedUserPhone(int $user_phone_id, string $contact_name): Advert
    {
        // добавляем связь телефона с объявлением в пивот
        $this->userPhones()->syncWithoutDetaching([$user_phone_id]);

        // открепляем предыдущий телефон от объявления
        $this->userPhones()->update([
            'selected' => 0
        ]);

        // прикрепляем новый телефон
        $this->userPhones()->updateExistingPivot($user_phone_id, [
            'selected' => 1,
            'contact_name' => $contact_name
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
        return $this->status === AdvertStatusEnum::ACTIVE->value;
    }

    /**
     * Возвращает имя для контактов объявления.
     * 
     * @return string
     */
    public function getContactNameAttribute(): string
    {
        return $this->selectedUserPhone()?->pivot->contact_name ?? $this->owner->name;
    }

    /**
     * Возвращает контактный номер телефона.
     * 
     * @return string
     */
    public function getPhoneNumberAttribute(): string
    {
        return $this->selectedUserPhone()?->number;
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
        $this->status = AdvertStatusEnum::WAIT_PHONE->value;
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
        $this->status = AdvertStatusEnum::ACTIVE->value;
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
        $this->status = AdvertStatusEnum::WAIT_MODERATION->value;
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
        return $query->where('status', AdvertStatusEnum::WAIT_MODERATION->value);
    }

    /**
     * Возвращает true, если объявление требует модерации.
     * 
     * @return bool
     */
    public function isWaitModeration(): bool
    {
        return $this->status === AdvertStatusEnum::WAIT_MODERATION->value;
    }

    /**
     * Возвращает текстовый лейбл статуса объявления.
     * 
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        return AdvertStatusEnum::from($this->status)->label();
    }

    /**
     * Все активные объявления.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', AdvertStatusEnum::ACTIVE->value);
    }
}
