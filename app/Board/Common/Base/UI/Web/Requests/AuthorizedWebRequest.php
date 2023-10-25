<?php

declare(strict_types=1);

namespace App\Board\Common\Base\UI\Web\Requests;

use App\Board\Common\Base\Data\DTO\AuthorizedRequestDTO;
use App\Board\Common\Contracts\Requests\AuthorizedWebRequest as AuthorizedWebRequestContract;

abstract class AuthorizedWebRequest extends BaseWebRequest implements AuthorizedWebRequestContract
{
    public function toDto(): AuthorizedRequestDTO
    {
        return new AuthorizedRequestDTO(
            user_id: auth()->id(),
            scope: $this->validated('scope'),
            data: $this->validated('data'),
        );
    }
}
