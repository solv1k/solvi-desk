<?php

declare(strict_types=1);

namespace App\Facades;

use App\Models\GeneralSetting as AppGeneralSetting;
use Illuminate\Support\Facades\Facade;

final class GeneralSetting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AppGeneralSetting::class;
    }
}
