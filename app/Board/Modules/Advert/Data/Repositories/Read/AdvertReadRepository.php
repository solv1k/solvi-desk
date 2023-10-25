<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Data\Repositories\Read;

use App\Board\Common\Base\Data\DataPaginator;
use App\Board\Common\Contracts\Repositories\ReadRepository;

interface AdvertReadRepository extends ReadRepository
{
    public function paginate(): DataPaginator;
}
