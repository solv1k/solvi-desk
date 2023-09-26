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

            $advert->fill($dto->toArray());

            // если модель объявления была изменена, то отправляем на модерацию
            if ($advert->isDirty([
                'advert_category_id',
                'title',
                'description'
            ])) {
                $advert->setModerateStatus();
            }

            $advert->save();

            // если в запросе есть изображение для объявления
            if (request()->hasFile('image')) {
                // удаляем предыдущее изображение
                if ($advert->hasMainImage()) {
                    $this->fileService->deleteImage($advert->main_image_path);
                }
                // загружаем новое изображение
                $image_path = $this->fileService->storeImage(request()->file('image'));
                $advert->setMainImage($image_path);
            }

            DB::commit();
    
            return $advert;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
