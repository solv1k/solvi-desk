<?php

namespace App\Services\File;

/**
 * Интерфейс для работы с файлами и изображениями.
 */
interface FileService
{
    /**
     * Сохраняет изображение и возвращает полный путь.
     * 
     * @param \Illuminate\Http\UploadedFile $image Загружаемое изображение
     * @param string $path Директория, в которую необходимо сохранить изображение
     * @return string Полный путь к сохраненному изображению
     */
    public function storeImage(
        \Illuminate\Http\UploadedFile $image,
        string $path = 'public/adverts/images'
    ): string;

    /**
     * Удаляет изображение и возвращает булево значение результата удаления.
     * 
     * @return bool
     */
    public function deleteImage(string $path): bool;
}
