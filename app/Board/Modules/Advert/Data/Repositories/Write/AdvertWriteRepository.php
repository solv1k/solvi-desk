<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Data\Repositories\Write;

use App\Board\Common\Entities\AdvertEntity;
use App\Board\Common\Contracts\Repositories\WriteRepository;
use App\Board\Modules\Advert\Data\DTO\CreateAdvertDTO;

interface AdvertWriteRepository extends WriteRepository
{
    public function create(CreateAdvertDTO $dto): AdvertEntity;
}
