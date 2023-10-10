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
    public function getModerateAttributes(): array
    {
        return is_array($this->moderate)
            ? $this->moderate
            : throw new \Exception('Please fill $moderated property in ' . $this::class);
    }

    /**
     * Возвращает массив атрибутов, которые после изменения требуют произвести модерацию модели.
     *
     * @return array<string>
     */
    public static function moderateAttributes(): array
    {
        $model = new static();
        return $model->getModerateAttributes();
    }

    /**
     * True, если модель требует модерации.
     *
     * @return boolean
     */
    public function isNeedModeration(): bool
    {
        return $this->isDirty($this->getModerateAttributes());
    }
}
