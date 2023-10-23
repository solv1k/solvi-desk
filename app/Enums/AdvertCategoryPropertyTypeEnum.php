<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Типы свойств категорий.
 */
enum AdvertCategoryPropertyTypeEnum: string
{
    case STRING = 'string';
    case INTEGER = 'integer';
    case FLOAT = 'float';
    case SELECT = 'select';
}
