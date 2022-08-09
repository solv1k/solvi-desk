<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Телефон пользователя.
 */
class UserPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number'
    ];
}
