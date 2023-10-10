<?php

declare(strict_types=1);

namespace Src\Ship\Contracts\Services\File;

use Src\Ship\Contracts\Common\File\UploadedFile;

/**
 * Интерфейс для работы с изображениями.
 */
interface ImageFileService
{
    /**
     * Сохраняет изображение и возвращает полный путь.
     * 
     * @param UploadedFile $image Загружаемое изображение
     * @param string $path Директория, в которую необходимо сохранить изображение
     * @return string Полный путь к сохраненному изображению
     */
    public function store(
        UploadedFile $image,
        string $path = 'public/uploads/images'
    ): string;

    /**
     * Удаляет изображение и возвращает булево значение результата удаления.
     * 
     * @return bool
     */
    public function delete(string $path): bool;
}
