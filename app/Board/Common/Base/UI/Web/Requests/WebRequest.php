<?php

declare(strict_types=1);

namespace App\Board\Common\Base\UI\Web\Requests;

use App\Board\Common\Base\Data\DTO\RequestDTO;
use App\Board\Common\Contracts\Requests\WebRequest as WebRequestContract;

abstract class WebRequest extends BaseWebRequest implements WebRequestContract
{
    public function toDto(): RequestDTO
    {
        return new RequestDTO(
            scope: $this->validated('scope'),
            data: $this->validated('data'),
        );
    }
}
