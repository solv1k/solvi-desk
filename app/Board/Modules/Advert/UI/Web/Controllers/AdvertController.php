<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\UI\Web\Controllers;

use App\Board\Common\Base\UI\Web\Controllers\BaseWebController;
use App\Board\Common\Contracts\Modules\Facades\AdvertFacade;

abstract class AdvertController extends BaseWebController
{
    public function __construct(
        protected AdvertFacade $facade
    ) {
    }
}
