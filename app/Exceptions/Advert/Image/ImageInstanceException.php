<?php

declare(strict_types=1);

namespace App\Exceptions\Advert\Image;

final class ImageInstanceException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Image must be instance of \Illuminate\Http\UploadedFile.');
    }
}
