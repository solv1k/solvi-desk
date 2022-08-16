## О проекте

Движок для создания доски объявлений.

## Технологии

- PHP 8.1
- Laravel 9

## Важные зависимости

Для динамических компонентов используется [Laravel Livewire](https://github.com/livewire/livewire)

Для организации дерева потомков и родителей используется [Laravel Nested Set](https://github.com/lazychaser/laravel-nestedset)

Для генерации превью (тамбнейлов) используется [Laravel Thumbnail](https://github.com/rolandstarke/laravel-thumbnail)

Для загрузки файлов и картинок используется библиотека [Filepond](https://github.com/pqina/filepond)

## Первый запуск

Для первого запуска требуется выполнить команду `sail artisan migrate:fresh && sail artisan db:seed`. Это создаст все необходимые таблицы в базе данных.

## Лицензия

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
