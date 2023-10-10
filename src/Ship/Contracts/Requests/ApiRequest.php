<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Requests;

interface ApiRequest
{
    public function authorize(): bool;

    public function rules(): array;
}
