<?php

declare(strict_types=1);

namespace App\Actions\User\Advert;

use App\DTO\User\Advert\StoreUserAdvertDTO;
use App\Exceptions\Advert\Image\ImageInstanceException;
use App\Models\Advert;
use App\Models\User;
use App\Services\Image\ImageService;
use Illuminate\Support\Facades\DB;

final class StoreUserAdvertAction
{
    public function __construct(
        protected ImageService $imageService
    ) {

    }

    /**
     * Сохраняет объявление пользователя в БД и возвращает его модель.
     */
    public function run(User $user, StoreUserAdvertDTO $dto): Advert
    {
        try {
            DB::beginTransaction();

            // создаем новое объявление
            /** @var Advert */
            $advert = $user->adverts()->create($dto->toArray());

            // если есть изображение, то сохраняем его
            // и устанавилваем в качестве главного изображения объявления
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                if (! $image instanceof \Illuminate\Http\UploadedFile) {
                    throw new ImageInstanceException();
                }
                $imagePath = $this->imageService->storeImage($image);
                $advert->setMainImage($imagePath);
            }

            // устанавливаем статус "необходимо указать номер телефона"
            $advert->setWaitPhoneStatus();

            DB::commit();

            return $advert;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
