<?php

namespace App\Services\File;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Сервис для загрузки файлов и изображений.
 */
class BasicFileService implements FileService
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
    ): string {
        $thumbFilename = md5(bin2hex(random_bytes(32))) . '.webp';

        $storagePath = storage_path('app' . DIRECTORY_SEPARATOR . $path);

        if (! file_exists($storagePath)) {
            mkdir(directory: $storagePath, recursive: true);
        }

        $thumbStorePath = storage_path('app' . DIRECTORY_SEPARATOR . $path) . DIRECTORY_SEPARATOR . $thumbFilename;

        $thumb = Image::make($image->path());

        $thumb->resize(600, 450, function($constraint) {
            $constraint->aspectRatio();
        })->resizeCanvas(600, 450)->encode('webp', 70)->save($thumbStorePath);

        $thumbImagePath = $path . DIRECTORY_SEPARATOR . $thumbFilename;

        return $thumbImagePath;
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
