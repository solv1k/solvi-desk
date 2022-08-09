<?php

namespace App\Facades;

use App\Models\GeneralSetting as AppGeneralSetting;
use Illuminate\Support\Facades\Facade;

class GeneralSetting extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return AppGeneralSetting::class; 
    }
}