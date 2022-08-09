<?php

use App\Http\Controllers\Guest\AdvertController;
use App\Http\Controllers\Guest\MainController;
use Illuminate\Support\Facades\Route;

// Маршруты гостевого пользователя
Route::controller(MainController::class)->name('guest.')->group(function() {
    // главная страница сайта
    Route::get('/', 'home')->name('home');

    // Объявления
    Route::controller(AdvertController::class)->prefix('/adverts')->name('adverts.')->group(function() {
        Route::get('/{advert}', 'view')->name('view');
    });
});