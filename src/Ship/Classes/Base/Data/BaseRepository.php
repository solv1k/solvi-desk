<?php

declare(strict_types=1);

namespace Src\Ship\Classes\Base\Data;

use Src\Ship\Contracts\Data\Repositories\ReadRepository;
use Src\Ship\Contracts\Data\Repositories\WriteRepository;

abstract class BaseRepository implements ReadRepository, WriteRepository
{
    protected $builder;
}
