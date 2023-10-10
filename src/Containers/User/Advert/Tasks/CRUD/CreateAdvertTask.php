<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Tasks\CRUD;

use Src\Containers\User\Advert\Data\DTO\CreateUserAdvertDTO;
use Src\Containers\User\Advert\Data\DTO\UserAdvertDTO;
use Src\Containers\User\Advert\Data\Repositories\WriteUserAdvertRepository;

class CreateAdvertTask
{
    public function __construct(
        protected WriteUserAdvertRepository $repository
    ) {}

    /**
     * Create a new user advert.
     *
     * @param CreateUserAdvertDTO $dto
     * @return UserAdvertDTO
     */
    public function run(CreateUserAdvertDTO $dto): UserAdvertDTO
    {
        return $this->repository->create($dto);
    }
}
