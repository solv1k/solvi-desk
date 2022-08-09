<?php

use App\Http\Controllers\User\AdvertController;
use App\Http\Controllers\User\AdvertPhoneController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserPhoneController;
use Illuminate\Support\Facades\Route;

// Маршруты пользователя
Route::middleware(['auth'])->prefix('/user')->name('user.')->group(function() {

    // Личный кабинет
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Телефоны
    Route::controller(UserPhoneController::class)->prefix('/phones')->name('phones.')->group(function() {
        // список всех телефонов пользователя
        Route::get('/', 'index')->name('list');
        // страница добавления нового телефона
        Route::get('/attach', 'attach')->name('attach');
        // обработчик добавления нового телефона
        Route::post('/', 'store')->name('store');
    });

    // Объявления
    Route::controller(AdvertController::class)->prefix('/adverts')->name('adverts.')->group(function() {
        // список всех объявлений пользователя
        Route::get('/', 'index')->name('list');
        // форма создания объявления
        Route::get('/create', 'create')->name('create');
        // обработчик создания объявления
        Route::post('/create', 'store')->name('store');
        // управление телефонами объявления
        Route::controller(AdvertPhoneController::class)->prefix('/{advert}/phones')->name('phones.')->group(function() {
            // список телефонов доступных для прикрепления к объявлению
            Route::get('/', 'index')->name('list');
            // привязка конкретного телефона к объявлению
            Route::post('/attach', 'attach')->name('attach');
        });
        // группа маршрутов по конкретному объявлению
        Route::prefix('/{advert}')->group(function() {
            // страница просмотра объявления
            Route::get('/', 'view')->name('view');
            // страница редактирования объявления
            Route::get('/edit', 'edit')->name('edit');
            // обработчик редактирования объявления
            Route::post('/edit', 'update')->name('update');
        });
    });

});