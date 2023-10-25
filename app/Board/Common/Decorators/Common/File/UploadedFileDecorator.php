<?php

declare(strict_types=1);

namespace App\Board\Common\Decorators\Common\File;

use Illuminate\Http\UploadedFile as IlluminateUploadedFile;

final class UploadedFileDecorator implements UploadedFile
{
    public function __construct(
        private IlluminateUploadedFile $file
    ) {
    }

    /**
     * Get the fully qualified path to the file.
     */
    public function path(): string
    {
        return $this->file->path();
    }
}
