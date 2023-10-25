<?php

declare(strict_types=1);

namespace App\Board\Common\Decorators\Common\File;

interface UploadedFile
{
    /**
     * Get the fully qualified path to the file.
     */
    public function path(): string;
}
