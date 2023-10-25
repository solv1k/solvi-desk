<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Logic\Actions\Write;

use App\Board\Common\Base\Data\DTO\AuthorizedRequestDTO;
use App\Board\Common\Entities\AdvertEntity;
use App\Board\Modules\Advert\Data\DTO\CreateAdvertDTO;
use App\Board\Modules\Advert\Data\Repositories\Write\AdvertWriteRepository;

final class CreateAdvertAction
{
    public function __construct(
        protected AdvertWriteRepository $repository
    ) {
    }

    public function run(AuthorizedRequestDTO $dto): AdvertEntity
    {
        return $this->repository->create(
            CreateAdvertDTO::from($dto->data)
        );
    }
}
