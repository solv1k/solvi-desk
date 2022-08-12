<?php

namespace App\Services;

/**
 * Сервис для работы с объявлениями.
 */
class AdvertService
{
    /**
     * Обновляет данные объявления из входящего запроса.
     * 
     * @param \App\Http\Requests\User\AdvertStoreRequest|\App\Http\Requests\User\AdvertUpdateRequest $request
     * @return \App\Http\Requests\User\AdvertStoreRequest|\App\Http\Requests\User\AdvertUpdateRequest
     */
    public function updateRequestData($request)
    {
        if ($request->description) {
            $request->merge([
                'description' => nl2br(multitrim(strip_tags($request->description)))
            ]);
        }

        return $request;
    }
}