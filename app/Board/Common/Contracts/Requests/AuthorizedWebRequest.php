<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Requests;

use App\Board\Common\Base\Data\DTO\AuthorizedRequestDTO;

interface AuthorizedWebRequest extends FormRequest
{
    public function toDto(): AuthorizedRequestDTO;
}
