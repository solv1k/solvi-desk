<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class ActivationController extends Controller
{
    /**
     * Страница активации пользователя.
     */
    public function index(Request $request): View|RedirectResponse
    {
        /** @var \App\Models\User */
        $user = $request->user();

        // если пользователь уже активирован, то отправляем его на главную страницу личного кабинета
        if ($user->isActivated()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return view('auth.activation');
    }

    /**
     * Обработчик отправки сообщения с ссылкой активации аккаунта пользователя.
     */
    public function sendActivationLink(Request $request): bool
    {
        /** @var \App\Models\User */
        $user = $request->user();

        // если пользователь уже активирован, то ничего не делаем
        if ($user->isActivated()) {
            return false;
        }

        // используем стандартный метод отправки письма для верификации аккаунта
        $user->sendEmailVerificationNotification();

        return true;
    }
}
