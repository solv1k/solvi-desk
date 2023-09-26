## О проекте

Boilerplate бесплатной доски объявлений.

## Технологии

- PHP 8.1
- Laravel 9

## Важные зависимости

Для динамических компонентов используется [Laravel Livewire](https://github.com/livewire/livewire)

Для организации дерева потомков и родителей используется [Laravel Nested Set](https://github.com/lazychaser/laravel-nestedset)

Для генерации превью (тамбнейлов) используется [Laravel Thumbnail](https://github.com/rolandstarke/laravel-thumbnail)

Для загрузки файлов и картинок используется библиотека [Filepond](https://github.com/pqina/filepond)

Для хлебных крошек (breadcrumbs) используется библиотека [Laravel Breadcrumbs](https://github.com/diglactic/laravel-breadcrumbs)

Для генерации слагов (slugs) используется библиотека [Slug Generator](https://github.com/ausi/slug-generator)

## Установка (первый запуск приложения)

Для первого запуска требуется установить утилиту `make` и выполнить из папки с проектом команду:

```
make install && \
make up && \
sleep 10 && \
make migrate && \
make seed && \
make storage-link
```

## Режим разработки

Для запуска в режиме разработки необходимо выполнить команду:
```
make up
```

По умолчанию в режиме разработки запускается **Laravel Sail** и всё приложение крутится в Docker-контейнерах.

Таким образом вы можете использовать любые команды Sail из корневой папки с проектом, например для запуска миграций БД:
```
./vendor/bin/sail artisan migrate
```

Для завершения Sail необходимо выполнить команду:
```
make down
```

## Тестовые аккаунты и доступы

Admin email: `super@admin.com`

Admin password: `password`

## Отправка SMS

По умолчанию отправка СМС-сообщений сделана через фейковых сервис, все сообщения появляются в debugbar-е на вкладке "Messages".

Для привязки реального СМС-провайдера требуется реализовать отправщик, имплеменитруя интерфейс `\App\Services\Sms\SmsService` и связать его в сервис-провайдере `\App\Providers\AppServiceProvider`.

## Отправка Email

По умолчанию отправка Email-сообщений происходит через фейковый сервис `mailhog`.

Все отправленные письма доступны по адресу `http://localhost:8025`.

Если вам потребуется использовать реальный Email-провайдер, то необходимо указать настройки в файле `.env`.

## Лицензия

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
