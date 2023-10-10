<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Data\Repositories;

use Src\Containers\User\Advert\Data\DTO\CreateUserAdvertDTO;
use Src\Containers\User\Advert\Data\DTO\UpdateUserAdvertDTO;
use Src\Containers\User\Advert\Data\DTO\UserAdvertDTO;
use Src\Ship\Contracts\Data\Repositories\WriteRepository;

interface WriteUserAdvertRepository extends WriteRepository
{
    /**
     * Create new advert for user.
     *
     * @param CreateUserAdvertDTO $dto
     * @return UserAdvertDTO
     */
    public function create(CreateUserAdvertDTO $dto): UserAdvertDTO;

    /**
     * Updating user advert.
     *
     * @param UpdateUserAdvertDTO $dto
     * @return integer
     */
    public function update(UpdateUserAdvertDTO $dto): int;

    /**
     * Set main image for advert.
     *
     * @param integer $advertId
     * @param string $imagePath
     * @return void
     */
    public function setMainImage(int $advertId, string $imagePath): void;

    /**
     * Set the "WAIT PHONE" status for advert.
     *
     * @param integer $advertId
     * @return void
     */
    public function setWaitPhoneStatus(int $advertId): void;
}
