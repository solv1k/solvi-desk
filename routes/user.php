<?php

use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\User\AdvertController;
use App\Http\Controllers\User\AdvertPhoneController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserPhoneController;
use Illuminate\Support\Facades\Route;

// Маршруты пользователя
Route::middleware(['auth'])->prefix('/user')->name('user.')->group(function() {

    // активация аккаунта
    Route::controller(ActivationController::class)->prefix('/activation')->name('activation.')->group(function() {
        // страница активации аккаунта
        Route::get('/', 'index')->name('page');
        // обработчик отправки письма с ссылкой активации
        Route::post('/', 'sendActivationLink')->middleware(['throttle:2,1'])->name('send-link');
    });

    // только для активированных пользователей
    Route::middleware(['user.active'])->group(function() {
        // Личный кабинет
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Телефоны
        Route::controller(UserPhoneController::class)->prefix('/phones')->name('phones.')->group(function() {
            // список всех телефонов пользователя
            Route::get('/', 'index')->name('list');
            // страница добавления нового телефона
            Route::get('/attach', 'attach')->name('attach');
            // обработчик проверки перед добавлением нового телефона
            Route::post('/', 'storeChecker')->name('store');
            // обработчик добавления нового телефона
            Route::post('/store', 'store')->name('store.confirmed');
            // страница верификации телефона
            Route::get('/verify/{userPhone}', 'verifyPage')->name('verify.page');
            // обработчик верификации телефона
            Route::post('/verify/{userPhone}', 'verifyHandler')->name('verify.handler');
            // отмена верификации телефона
            Route::get('/verify/{userPhone}/cancel', 'verifyCancel')->name('verify.cancel');
        });

        // Объявления
        Route::controller(AdvertController::class)->prefix('/adverts')->name('adverts.')->group(function() {
            // список всех объявлений пользователя
            Route::get('/', 'index')->name('list');
            // список всех объявлений, которые понравились пользователю
            Route::get('/liked', 'liked')->name('liked');
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

});