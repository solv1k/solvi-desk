<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Logic\Actions\Read;

use App\Board\Common\Entities\AdvertEntity;
use App\Board\Modules\Advert\Data\Repositories\Read\AdvertReadRepository;

final class ListAdvertAction
{
    public function __construct(
        protected AdvertReadRepository $repository
    ) {
    }

    /**
     * @return array<AdvertEntity>
     */
    public function run(): array
    {
        return $this->repository->paginate()->toArray();
    }
}
