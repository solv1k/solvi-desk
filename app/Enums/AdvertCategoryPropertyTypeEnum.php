<?php

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
