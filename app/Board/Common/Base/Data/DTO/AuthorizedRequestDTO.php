<?php

declare(strict_types=1);

namespace App\Board\Common\Base\Data\DTO;

final class AuthorizedRequestDTO extends AbstractRequestDTO
{
    public function __construct(
        public int|string $user_id,
        public string $scope,
        /** @var ?array<string, mixed> */
        public ?array $data,
    ) {
        parent::__construct($scope, $data);

        $this->data = array_merge(
            ['user_id' => $this->user_id],
            $this->data ?? []
        );
    }
}
