<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Сервис для загрузки файлов и изображений.
 */
class FileService
{
    /**
     * Сохраняет изображение и возвращает полный путь.
     * 
     * @param \Illuminate\Http\UploadedFile $image  Загруженная картинка
     * @param string $path  Директория, в которую необходимо сохранить изображение
     * @return string   Полный путь к сохраненному изображению
     */
    public function storeImage(\Illuminate\Http\UploadedFile $image, string $path = 'public/adverts/images'): string
    {
        $thumb_filename = md5(bin2hex(random_bytes(32))) . '.' . $image->extension();

        $thumb_store_path = storage_path('app' . DIRECTORY_SEPARATOR . $path) . DIRECTORY_SEPARATOR . $thumb_filename;

        $thumb = Image::make($image->path());

        $thumb->resize(600, 450, function($constraint) {
            $constraint->aspectRatio();
        })->resizeCanvas(600, 450)->save($thumb_store_path);

        $thumb_image_path = $path . DIRECTORY_SEPARATOR . $thumb_filename;

        return $thumb_image_path;
    }

    /**
     * Удаляет изображение и возвращает булево значение результата удаления.
     * 
     * @return bool
     */
    public function deleteImage(string $path): bool
    {
        return Storage::delete($path);
    }
}