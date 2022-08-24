<?php

namespace App\Models;

use App\Traits\OrderableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Категория объявления.
 */
class AdvertCategory extends Model
{
    use HasFactory, SoftDeletes, NodeTrait, OrderableModel;

    protected $fillable = [
        'title',
        'description',
        'icon_symbol',
        'icon_color',
        'order'
    ];

    /**
     * Объявления в категории.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    /**
     * Свойства категории.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany(AdvertCategoryProperty::class);
    }
}
