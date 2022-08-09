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