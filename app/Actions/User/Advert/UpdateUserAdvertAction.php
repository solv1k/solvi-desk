<?php

declare(strict_types=1);

namespace App\Actions\User\Advert;

use App\DTO\User\Advert\UpdateUserAdvertDTO;
use App\Models\Advert;
use App\Services\File\FileService;
use Illuminate\Support\Facades\DB;

class UpdateUserAdvertAction
{
    public function __construct(
        protected FileService $fileService,
    ) {
        
    }

    /**
     * Сохраняет объявление пользователя в БД и возвращает его модель.
     *
     * @return Advert
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
     *
     * @param Advert $advert
     * @return void
     */
    protected function updateMainImage(Advert $advert): void
    {
        // удаляем предыдущее изображение
        if ($advert->hasMainImage()) {
            $this->fileService->deleteImage($advert->main_image_path);
        }
        // загружаем новое изображение
        $image_path = $this->fileService->storeImage(request()->file('image'));
        $advert->setMainImage($image_path);
    }
}
