<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Models\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Категория объявления.
 */
final class AdvertCategory extends Model
{
    use HasFactory;
    use HasOrder;
    use NodeTrait;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'icon_symbol',
        'icon_color',
        'order',
    ];

    /**
     * Объявления в категории.
     *
     * @return HasMany<Advert>
     */
    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class);
    }

    /**
     * Свойства категории.
     *
     * @return HasMany<AdvertCategoryProperty>
     */
    public function properties()
    {
        return $this->hasMany(AdvertCategoryProperty::class);
    }

    public function advertCountWithDescendants(): int
    {
        return $this->adverts()->count()
            /** @phpstan-ignore-next-line */
            + $this->descendants()->withCount('adverts')->get()->sum('adverts_count');
    }
}
