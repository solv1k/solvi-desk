<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Позиция баннера.
 */
final class BannerPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'width',
        'height',
        'daily_price',
    ];
}
