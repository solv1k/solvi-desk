<?php

declare(strict_types=1);

namespace App\Board\Common\Base\Data\DTO;

use Spatie\LaravelData\Data;

abstract class AbstractRequestDTO extends Data
{
    public function __construct(
        public string $scope,
        /** @var ?array<string, mixed> */
        public ?array $data,
    ) {
    }
}
