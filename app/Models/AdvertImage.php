<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Изображение, прикрепленное к объявлению.
 */
final class AdvertImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
    ];
}
