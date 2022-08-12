<?php

use App\Http\Controllers\Admin\AdvertController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Маршруты администратора
Route::middleware(['auth', 'admin'])->prefix('/admin')->name('admin.')->group(function() {

    // Панель администратора
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Объявления
    Route::controller(AdvertController::class)->prefix('/adverts')->name('adverts.')->group(function() {
        // страница управления объявлениями
        Route::get('/', 'index')->name('index');
        // список всех объявлений
        Route::get('/all', 'list')->name('list');
        // активные объявления
        Route::get('/active', 'active')->name('active.list');
        // объявления, ожидающие модерации
        Route::get('/waitmoderate', 'waitmoderate')->name('waitmoderate.list');
        // группа маршрутов по конкретному объявлению
        Route::prefix('/{advert}')->group(function() {
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

});