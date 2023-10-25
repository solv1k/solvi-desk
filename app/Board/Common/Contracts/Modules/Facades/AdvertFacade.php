<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Modules\Facades;

use App\Board\Common\Base\Data\DTO\AuthorizedRequestDTO;
use App\Board\Common\Contracts\Facades\ModuleFacade;
use App\Board\Common\Contracts\Modules\Config\AdvertConfig;
use App\Board\Common\Entities\AdvertEntity;

interface AdvertFacade extends ModuleFacade
{
    public function config(): AdvertConfig;

    public function create(AuthorizedRequestDTO $dto): AdvertEntity;
}
