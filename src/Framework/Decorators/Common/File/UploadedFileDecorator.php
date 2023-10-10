<?php

declare(strict_types=1);

namespace Src\Framework\Decorators\Common\File;

use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Src\Ship\Contracts\Common\File\UploadedFile;

class UploadedFileDecorator implements UploadedFile
{
    public function __construct(
        private HttpUploadedFile $file
    ) {}

    /**
     * Get the fully qualified path to the file.
     *
     * @return string
     */
    public function path(): string
    {
        return $this->file->path();
    }
}
