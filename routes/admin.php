<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AdvertController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Маршруты администратора
Route::middleware(['auth', 'admin'])->prefix('/admin')->name('admin.')->group(static function (): void {

    // Панель администратора
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Объявления
    Route::controller(AdvertController::class)->prefix('/adverts')->name('adverts.')->group(static function (): void {
        // страница управления объявлениями
        Route::get('/', 'index')->name('index');
        // список всех объявлений
        Route::get('/all', 'list')->name('list');
        // активные объявления
        Route::get('/active', 'active')->name('active.list');
        // объявления, ожидающие модерации
        Route::get('/waitmoderate', 'waitmoderate')->name('waitmoderate.list');
        // группа маршрутов по конкретному объявлению
        Route::prefix('/{advert}')->group(static function (): void {
            // страница просмотра объявления
            Route::get('/', 'view')->name('view');
            // страница редактирования объявления
            Route::get('/edit', 'edit')->name('edit');
            // обработчик редактирования объявления
            Route::post('/edit', 'update')->name('update');
            // обработчик активации объявления
            Route::get('/activate', 'activate')->name('activate');
            // обработчик отправки объявления на модерацию
            Route::get('/to-moderation', 'toModeration')->name('to-moderation');
        });
    });

    // Категории объявлений
    Route::controller(CategoriesController::class)->prefix('/categories')->name('categories.')->group(static function (): void {
        // страница управления категориями
        Route::get('/', 'index')->name('index');
        // группа маршрутов по конкретной категории объявления
        Route::prefix('/{category}')->group(static function (): void {
            // страница просмотра категории объявления
            Route::get('/', 'view')->name('view');
        });
    });

});
