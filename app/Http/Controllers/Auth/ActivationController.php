<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    /**
     * Страница активации пользователя.
     * 
     * @return \Illuminate\Contracts\View\View
     */    
    public function index()
    {
       return view('auth.activation');
    }

    /**
     * Обработчик отправки сообщения с ссылкой активации аккаунта пользователя.
     * 
     * @return mixed
     */
    public function sendActivationLink(Request $request)
    {
        /** @var \App\Models\User */
        $user = $request->user();

        // если юзер уже активирован ничего не делаем
        if ($user->isActivated()) {
            return false;
        }

        // используем стандартный метод отправки письма для верификации аккаунта
        $user->sendEmailVerificationNotification();
    }
}
