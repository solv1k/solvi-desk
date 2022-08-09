<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Изображение, прикрепленное к объявлению.
 */
class AdvertImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path'
    ];
}
