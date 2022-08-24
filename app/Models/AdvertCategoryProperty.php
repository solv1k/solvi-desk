<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertCategoryProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'additional_data',
        'validation_rules',
        'prefix',
        'suffix'
    ];
}
