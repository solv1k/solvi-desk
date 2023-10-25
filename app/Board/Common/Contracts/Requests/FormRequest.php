<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Requests;

interface FormRequest
{
    public function authorize(): bool;

    /**
     * @return array<string, string|array<mixed>>
     */
    public function baseRules(): array;

    /**
     * @return array<string, string|array<mixed>>
     */
    public function validationRules(): array;

    /**
     * @return array<string, string|array<mixed>>
     */
    public function rules(): array;

    /**
     * @phpstan-ignore-next-line
     */
    public function validated($key = null, $default = null);
}
