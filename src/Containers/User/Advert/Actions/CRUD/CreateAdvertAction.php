<?php

declare(strict_types=1);

namespace Src\Containers\User\Advert\Actions\CRUD;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Src\Containers\User\Advert\Data\DTO\CreateUserAdvertDTO;
use Src\Containers\User\Advert\Data\DTO\UserAdvertDTO;
use Src\Containers\User\Advert\Tasks\CRUD\CreateAdvertTask;
use Src\Containers\User\Advert\Tasks\Image\SetAdvertMainImageTask;
use Src\Containers\User\Advert\Tasks\Status\SetAdvertWaitPhoneStatusTask;
use Src\Framework\Decorators\Common\File\UploadedFileDecorator;
use Src\Ship\Contracts\Services\File\ImageFileService;

class CreateAdvertAction
{
    public function __construct(
        protected ImageFileService $imageFileService,
        protected CreateAdvertTask $createAdvertTask,
        protected SetAdvertMainImageTask $setAdvertMainImageTask,
        protected SetAdvertWaitPhoneStatusTask $setAdvertWaitPhoneStatusTask,
    ) {}

    /**
     * Сохраняет объявление пользователя в БД и возвращает его DTO.
     *
     * @return UserAdvertDTO
     */
    public function run(CreateUserAdvertDTO $dto): UserAdvertDTO
    {
        try {
            DB::beginTransaction();
            // создаем новое объявление
            $advert = $this->createAdvertTask->run($dto);
            // если есть изображение, то сохраняем его 
            // и устанавилваем в качестве главного изображения объявления
            if (request()->hasFile('image')) {
                $imagePath = $this->imageFileService->store(new UploadedFileDecorator(request()->file('image')));
                $this->setAdvertMainImageTask->run($advert->id, $imagePath);
            }
            // устанавливаем статус "необходимо указать номер телефона"
            $this->setAdvertWaitPhoneStatusTask->run($advert->id);
            // коммитим изменения в БД
            DB::commit();
            return $advert;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
