<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert;

use App\Board\Common\Base\Data\DTO\AuthorizedRequestDTO;
use App\Board\Common\Contracts\Facades\BaseModuleFacade;
use App\Board\Common\Contracts\Modules\Facades\AdvertFacade as AdvertFacadeContract;
use App\Board\Common\Contracts\Modules\Config\AdvertConfig;
use App\Board\Common\Entities\AdvertEntity;
use App\Board\Modules\Advert\Logic\Actions\Write\CreateAdvertAction;

final class AdvertFacade extends BaseModuleFacade implements AdvertFacadeContract
{
    public function __construct(
        protected AdvertConfig $config,
        protected CreateAdvertAction $createAdvertAction,
    ) {
    }

    public function config(): AdvertConfig
    {
        return $this->config;
    }

    public function create(AuthorizedRequestDTO $dto): AdvertEntity
    {
        return $this->createAdvertAction->run($dto);
    }
}
