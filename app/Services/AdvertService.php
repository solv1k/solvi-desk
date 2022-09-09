<?php

namespace App\Services;

/**
 * Сервис для работы с объявлениями.
 */
class AdvertService
{
    /**
     * Преобразует описание объявления в валидный HTML-код.
     *
     * @param string $description
     * @return string
     */
    public function descriptionToHtml(string $description): string
    {
        return nl2br(multitrim(strip_tags($description)));
    }

    /**
     * Обновляет данные запроса и возвращает его назад.
     *
     * @param \App\Http\Requests\User\AdvertStoreRequest|\App\Http\Requests\User\AdvertUpdateRequest $request
     * @return \App\Http\Requests\User\AdvertStoreRequest|\App\Http\Requests\User\AdvertUpdateRequest
     */
    public function updateRequestData($request)
    {
        if ($request->has('description')) {
            $request->merge([
                'description' => $this->descriptionToHtml($request->description)
            ]);
        }

        return $request;
    }
}
