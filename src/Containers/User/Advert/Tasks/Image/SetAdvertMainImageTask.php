<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Tasks\Image;

use Src\Containers\User\Advert\Data\Repositories\WriteUserAdvertRepository;

class SetAdvertMainImageTask
{
    public function __construct(
        protected WriteUserAdvertRepository $repository
    ) {}

    /**
     * Set main image for advert.
     *
     * @param integer $advertId
     * @param string $imagePath
     * @return void
     */
    public function run(int $advertId, string $imagePath): void
    {
        $this->repository->setMainImage($advertId, $imagePath);
    }
}
