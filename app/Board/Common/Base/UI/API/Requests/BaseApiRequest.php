<?php

declare(strict_types=1);

namespace App\Board\Common\Base\UI\API\Requests;

use App\Board\Common\Contracts\Requests\FormRequest as FormRequestContract;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseApiRequest extends FormRequest implements FormRequestContract
{
}
