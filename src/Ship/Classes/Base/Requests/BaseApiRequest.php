<?php

declare(strict_types=1);

namespace Src\Ship\Classes\Base\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Ship\Contracts\Requests\ApiRequest;

abstract class BaseApiRequest extends FormRequest implements ApiRequest
{
    /**
     * Returns validated request data with "user_id = auth()->id()".
     *
     * @param string $key
     * @param mixed $default
     * @return void
     */
    public function validatedWithAuthId($key = null, $default = null)
    {
        return array_merge(['user_id' => auth()->id()], $this->validated($key, $default));
    }
}
