<?php

declare(strict_types=1);

namespace App\Actions\User\Advert;

use App\DTO\User\Advert\UpdateUserAdvertDTO;
use App\Exceptions\Advert\Image\ImageInstanceException;
use App\Models\Advert;
use App\Services\Image\ImageService;
use Illuminate\Support\Facades\DB;

final class UpdateUserAdvertAction
{
    public function __construct(
        protected ImageService $imageService,
    ) {

    }

    /**
     * Сохраняет объявление пользователя в БД и возвращает его модель.
     */
    public function run(Advert $advert, UpdateUserAdvertDTO $dto): Advert
    {
        try {
            DB::beginTransaction();

            // обновляем данные объявления
            $advert->update($dto->toArray());

            // если модель объявления была изменена, то отправляем на модерацию
            if ($advert->isNeedModeration()) {
                $advert->setModerateStatus();
            }

            // если в запросе есть изображение для объявления
            if (request()->hasFile('image')) {
                $this->updateMainImage($advert);
            }

            DB::commit();

            return $advert;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Обновляет главное изображение объявления.
     */
    protected function updateMainImage(Advert $advert): void
    {
        // удаляем предыдущее изображение
        if ($advert->hasMainImage()) {
            $this->imageService->deleteImage($advert->main_image_path);
        }
        // загружаем новое изображение
        $image = request()->file('image');
        if (! $image instanceof \Illuminate\Http\UploadedFile) {
            throw new ImageInstanceException();
        }
        $image_path = $this->imageService->storeImage($image);
        $advert->setMainImage($image_path);
    }
}
