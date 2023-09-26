<?php

declare(strict_types=1);

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
    function multitrim(?string $str): string {
        if (!$str) {
            return '';
        }

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
    function br2nl(?string $str): string
    {
        if (!$str) {
            return '';
        }

        return preg_replace('#<br\s*/?>#i', PHP_EOL, $str);
    }
}

if (! function_exists('untrim')) {
    /**
     * Добавляет пробелы в начале и конце строки.
     * 
     * @return string
     */
    function untrim(?string $str): string 
    {
        if (!$str) {
            return '';
        }

        return ' ' . $str . ' ';
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
        return url('images/placeholder.png');
    }
}

if (! function_exists('print_full_tree')) {
    /**
     * Возвращает дерево родителей и потомков для ноды в форматтер.
     */
    function print_full_tree($nodes, Closure $formatter, string $prefix = '-')
    {
        foreach ($nodes as $node) {
            $formatter($node, $prefix);
    
            print_full_tree($node->children, $formatter, $prefix . $prefix);
        }
    }
}

if (! function_exists('view_full_tree')) {
    /**
     * Возвращает дерево родителей и потомков для ноды во вьюшку.
     */
    function view_full_tree($nodes, string $view_path, string $prefix = '-')
    {
        foreach ($nodes as $node) {
            echo view($view_path, compact('node', 'prefix'))->render();
    
            view_full_tree($node->children, $view_path, $prefix . $prefix);
        }
    }
}

if (! function_exists('raw_string_to_html')) {
    /**
     * Преобразовывает строку в HTML и возвращает её.
     */
    function raw_string_to_html(string $string): string
    {
        return nl2br(multitrim(strip_tags($string)));
    }
}
