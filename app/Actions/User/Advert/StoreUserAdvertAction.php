<?php

declare(strict_types=1);

namespace App\Actions\User\Advert;

use App\DTO\User\Advert\StoreUserAdvertDTO;
use App\Models\Advert;
use App\Models\User;
use App\Services\File\FileService;
use Illuminate\Support\Facades\DB;

class StoreUserAdvertAction
{
    public function __construct(
        protected FileService $fileService
    ) {
        
    }

    /**
     * Сохраняет объявление пользователя в БД и возвращает его модель.
     *
     * @return Advert
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
                $image_path = $this->fileService->storeImage(request()->file('image'));
                $advert->setMainImage($image_path);
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
