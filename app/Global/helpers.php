<?php

if (! function_exists('price_format')) {
    /**
     * Возвращает цену в красивом формате.
     * 
     * @return string
     */
    function price_format(float $price): string {
        return number_format($price, 0, '', ' ');
    }
}

if (! function_exists('multitrim')) {
    /**
     * Убирает из строки все дублирующиеся пробелы и дублирующиеся переносы строк.
     * 
     * @return string
     */
    function multitrim(string $str): string {
        $str = trim($str);
        $str = preg_replace('/[\r\n]{2,}/', PHP_EOL, $str);
        $str = preg_replace('/\h+/', ' ', $str);

        return $str;
    }
}

if (! function_exists('br2nl')) {
    /**
     * Заменяет все <br /> на символ переноса строки.
     * 
     * @return string
     */
    function br2nl(string $str): string
    {
        return preg_replace('#<br\s*/?>#i', PHP_EOL, $str);
    }
}

if (! function_exists('advert_image_placeholder')) {
    /**
     * Возвращает URL "картинки-заглушки" для объявления.
     * 
     * @return string
     */
    function advert_image_placeholder(): string
    {
        return 'https://via.placeholder.com/240x180?text=Placeholder';
    }
}