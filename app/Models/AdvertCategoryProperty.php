<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Свойство категории объявлений.
 */
final class AdvertCategoryProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'additional_data',
        'validation_rules',
        'prefix',
        'suffix',
    ];
}
