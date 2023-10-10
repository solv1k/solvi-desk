<?php

declare(strict_types=1);

namespace Src\Ship\Enums\Routes;

enum RouteMethodEnum : string
{
    case GET = 'get';
    case POST = 'post';
    case PUT = 'put';
    case PATCH = 'patch';
    case DELETE = 'delete';
}
