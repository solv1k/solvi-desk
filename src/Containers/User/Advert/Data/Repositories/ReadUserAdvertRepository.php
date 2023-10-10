<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Data\Repositories;

use Src\Ship\Contracts\Data\Repositories\ReadRepository;

interface ReadUserAdvertRepository extends ReadRepository
{
    /**
     * Adding a query to search for user ads by ID.
     *
     * @param integer $userId
     * @param integer $advertId
     * @return static
     */
    public function findById(int $userId, int $advertId): static;

    /**
     * Adding a query to search for all of a users ads.
     *
     * @param integer $userId
     * @return static
     */
    public function all(int $userId): static;

    /**
     * Total count of user ads.
     *
     * @param integer $userId
     * @return integer
     */
    public function advertsCount(int $userId): int;

    /**
     * Total ads count liked by user.
     *
     * @param integer $userId
     * @return integer
     */
    public function likedAdvertsCount(int $userId): int;
}
