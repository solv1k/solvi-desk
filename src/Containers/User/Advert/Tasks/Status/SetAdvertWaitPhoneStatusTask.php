<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Tasks\Status;

use Src\Containers\User\Advert\Data\Repositories\WriteUserAdvertRepository;

class SetAdvertWaitPhoneStatusTask
{
    public function __construct(
        protected WriteUserAdvertRepository $repository
    ) {}

    /**
     * Set the "WAIT PHONE" status for advert.
     *
     * @param integer $advertId
     * @return void
     */
    public function run(int $advertId): void
    {
        $this->repository->setWaitPhoneStatus($advertId);
    }
}
