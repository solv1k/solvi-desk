<?php

declare(strict_types=1);

namespace Src\Ship\Classes\Base\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class BaseApiController extends Controller
{
    public function success($data = []): JsonResponse
    {
        return response()->json($data);
    }
}
