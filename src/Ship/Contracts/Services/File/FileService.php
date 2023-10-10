<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Services\File;

use Src\Ship\Contracts\Common\File\UploadedFile;

/**
 * Интерфейс для работы с файлами.
 */
interface FileService
{
    /**
     * Сохраняет файл и возвращает полный путь.
     * 
     * @param UploadedFile $file Загружаемый файл
     * @param string $path Директория, в которую необходимо сохранить файл
     * @return string Полный путь к сохраненному файлу
     */
    public function store(
        UploadedFile $file,
        string $path = 'public/uploads/files'
    ): string;

    /**
     * Удаляет файл и возвращает булево значение результата удаления.
     * 
     * @return bool
     */
    public function delete(string $path): bool;
}
