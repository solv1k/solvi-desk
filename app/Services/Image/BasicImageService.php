<?php

declare(strict_types=1);

namespace App\Services\Image;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Сервис для загрузки файлов и изображений.
 */
final class BasicImageService implements ImageService
{
    /**
     * Сохраняет изображение и возвращает его URI.
     *
     * @param  \Illuminate\Http\UploadedFile  $image Загружаемое изображение
     * @param  string  $path Директория, в которую необходимо сохранить изображение
     * @return string URI сохраненного изображения
     */
    public function storeImage(
        \Illuminate\Http\UploadedFile $image,
        string $path = 'public/adverts/images'
    ): string {
        // генерируем имя файла для сохраняемого изображения
        $thumbFilename = $this->generateThumbFilename();

        // получаем полный путь для сохраняемого изображения
        $thumbStorePath = $this->getStoragePath($path) . DIRECTORY_SEPARATOR . $thumbFilename;

        // изменяем изображение и сохраняем по указанному пути
        $this->resizeAndStoreImage($image, $thumbStorePath);

        // возвращаем URI для сохранненого изображения
        return $path . DIRECTORY_SEPARATOR . $thumbFilename;
    }

    /**
     * Удаляет изображение и возвращает булево значение результата удаления.
     */
    public function deleteImage(string $path): bool
    {
        return Storage::delete($path);
    }

    /**
     * Генерирует рандомное имя файла.
     *
     * @param  string  $extension
     */
    protected function generateThumbFilename($extension = 'webp'): string
    {
        return md5(bin2hex(random_bytes(32))) . ".$extension";
    }

    /**
     * Получает папку для сохранения файла.
     */
    protected function getStoragePath(string $path): string
    {
        $storagePath = storage_path('app' . DIRECTORY_SEPARATOR . $path);

        if (! file_exists($storagePath)) {
            mkdir(directory: $storagePath, recursive: true);
        }

        return $storagePath;
    }

    /**
     * Изменяет параметры изображения и сохраняет его по указанному пути.
     */
    protected function resizeAndStoreImage(
        \Illuminate\Http\UploadedFile $image,
        string $storePath,
        int $width = 600,
        int $height = 450,
        string $encoding = 'webp',
        int $quality = 70
    ): void {
        Image::make($image->path())
            ->resize($width, $height, static function ($constraint): void {
                $constraint->aspectRatio();
            })
            ->resizeCanvas($width, $height)
            ->encode($encoding, $quality)
            ->save($storePath);
    }
}
