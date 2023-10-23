<?php

declare(strict_types=1);

namespace App\Traits\Models;

trait HasModerateAttributes
{
    /**
     * Возвращает массив атрибутов, которые после изменения требуют произвести модерацию модели.
     *
     * @return array<string>
     */
    public static function moderateAttributes(): array
    {
        $model = new self();

        return $model->getModerateAttributes();
    }

    /**
     * Возвращает массив атрибутов, которые после изменения требуют произвести модерацию модели.
     *
     * @return array<string>
     */
    public function getModerateAttributes(): array
    {
        if (! is_array($this->moderate)) {
            throw new \Exception('Please fill $moderate property in ' . $this::class);
        }

        return $this->moderate;
    }

    /**
     * True, если модель требует модерации.
     */
    public function isNeedModeration(): bool
    {
        return $this->isDirty($this->getModerateAttributes());
    }
}
