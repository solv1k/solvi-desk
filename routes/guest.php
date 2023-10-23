<?php

declare(strict_types=1);

use App\Http\Controllers\Guest\AdvertController;
use App\Http\Controllers\Guest\MainController;
use Illuminate\Support\Facades\Route;

// Маршруты гостевого пользователя
Route::controller(MainController::class)->name('guest.')->group(static function (): void {
    // главная страница сайта
    Route::get('/', 'home')->name('home');

    // Объявления
    Route::controller(AdvertController::class)->prefix('/adverts')->name('adverts.')->group(static function (): void {
        Route::get('/{advert}', 'view')->name('view');
    });
});
