<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Common\File;

interface UploadedFile
{
    /**
     * Get the fully qualified path to the file.
     *
     * @return string
     */
    public function path(): string;
}
